<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use RealRashid\SweetAlert\Facades\Alert;

class JadwalController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        $petugas = \App\Models\Petugas::where('is_admin', 0)->get();
        $jadwal = \App\Models\Jadwal::with('petugas')->get();

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.jadwal', compact('petugas', 'jadwal'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'periode' => 'required',
            'lokasi' => 'required',
            'waktu' => 'required',
            'hari' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $petugas = \App\Models\Petugas::where('nik', $request->nik)->first();
            $jadwal = \App\Models\Jadwal::create([
                'periode' => $request->periode,
                'lokasi' => $request->lokasi,
                'waktu' => $request->waktu,
                'hari' => $request->hari,
                'petugas_id' => $petugas->id,
            ]);
            DB::commit();
            toast('Success', 'Data Added Successfully');
            return redirect('admin/jadwal')->with('success', 'Data Added Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            toast('Error', 'Data Added Failed');
            return redirect('admin/jadwal')->with('error', 'Data Added Failed');
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'periode' => 'required',
            'lokasi' => 'required',
            'waktu' => 'required',
            'hari' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $petugas = \App\Models\Petugas::where('nik', $request->nik)->first();
            $jadwal = \App\Models\Jadwal::find($id);
            $jadwal->update([
                'periode' => $request->periode,
                'lokasi' => $request->lokasi,
                'waktu' => $request->waktu,
                'hari' => $request->hari,
                'petugas_id' => $petugas->id,
            ]);
            DB::commit();
            toast('Success', 'Data Updated Successfully');
            return redirect('admin/jadwal')->with('success', 'Data Updated Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            toast('Error', 'Data Updated Failed');
            return redirect('admin/jadwal')->with('error', 'Data Updated Failed');
        }
    }
    public function destroy($id)
    {
        $jadwal = \App\Models\Jadwal::find($id);
        $jadwal->delete();
        toast('Success', 'Data Deleted Successfully');
        return redirect('admin/jadwal')->with('success', 'Data Deleted Successfully');
    }
}
