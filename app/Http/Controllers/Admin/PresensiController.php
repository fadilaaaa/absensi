<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PresensiExport;
use App\Models\Presensi;

class PresensiController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        $presensis = Presensi::getPeriodeYearPresensis();
        return view('admin.presensiPeriod', compact('presensis'));
    }
    public function periode(Request $request, $year, $periode)
    {
        $presensis = Presensi::join('petugas', 'presensis.petugas_id', '=', 'petugas.id')
            ->join('jadwals', 'petugas.id', '=', 'jadwals.petugas_id')
            ->select(
                'presensis.*',
                'jadwals.periode',
                'jadwals.lokasi',
                'petugas.name',
                'petugas.nik',
            )
            ->whereYear('presensis.created_at', $year)
            ->where('jadwals.periode', $periode)
            ->get();
        return view('admin.presensi', compact('presensis'));
    }
    public function export(Request $request, $year, $periode)
    {
        $time = date('Y-m-d H:i:s');
        return Excel::download(new PresensiExport(['year' => $year, 'periode' => $periode]), 'presensi_' . $time . '.xlsx');
    }
}
