<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Gaji;
use App\Models\Presensi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GajiController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        $bulan = ($request->get('bulan'))
            ? $request->get('bulan') :
            Carbon::now()->locale('id')->getTranslatedMonthName();
        $tahun = ($request->get('tahun'))
            ? $request->get('tahun') : Carbon::now()->year;
        $bulanint = $this->bulan2int($bulan);
        $presensiBulanIni = Presensi::getTotalPresensiBulanIni();
        $gajis = Gaji::whereMonth('created_at', $bulanint)
            ->whereYear('created_at', $tahun)
            ->get();

        if ($request->wantsJson()) {
            return response()->json([
                'data' => $gajis
            ], 200);
        }
        return view('admin.gaji', compact('gajis', 'bulan', 'tahun', 'presensiBulanIni'));
    }
    public function viewPetugas(Request $request)
    {
        $bulan = ($request->get('bulan'))
            ? $request->get('bulan') :
            Carbon::now()->locale('id')->getTranslatedMonthName();
        $tahun = ($request->get('tahun'))
            ? $request->get('tahun') : Carbon::now()->year;
        $gaji = Gaji::where('petugas_id', auth()->user()->petugas->id);
        if ($request->get('bulan')) {
            $bulan = $this->bulan2int($request->get('bulan'));
            $gaji = $gaji->whereMonth('created_at', $bulan);
        }
        if ($request->get('tahun')) {
            $tahun = $request->get('tahun');
            $gaji = $gaji->whereYear('created_at', $tahun);
        }
        $gaji = $gaji->get()->sortByDesc('created_at');
        return view('petugas.gaji', compact('gaji', 'bulan', 'tahun'));
    }
    public function regenerate()
    {
        $ubah = false;
        $baseGaji = 2500000;
        $gajis = Gaji::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->get();
        DB::beginTransaction();
        try {
            foreach ($gajis as $gaji) {
                if ($gaji->potongan != $gaji->petugas->getPotonganGajiBulanIni()) {
                    $ubah = true;
                    $gaji->potongan = $gaji->petugas->getPotonganGajiBulanIni();
                    $gaji->total = $baseGaji - ($baseGaji * $gaji->petugas->getPotonganGajiBulanIni() / 100);
                    $gaji->save();
                }
            }
            if ($ubah) {
                DB::commit();
                return redirect()->back()->with('success', 'Gaji berhasil di regenerasi');
            } else {
                return redirect()->back()->with('success', 'Tidak ada perubahan pada gaji');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gaji gagal di regenerasi');
        }
    }
    public function detail(Request $request, $id)
    {
        $bulan = ($request->get('bulan'))
            ? $request->get('bulan') :
            Carbon::now()->locale('id')->getTranslatedMonthName();
        $tahun = ($request->get('tahun'))
            ? $request->get('tahun') : Carbon::now()->year;
        $bulanint = $this->bulan2int($bulan);
        $gaji = Gaji::find($id);
        $petugas = $gaji->petugas;
        $detailPresensi = Presensi::where('petugas_id', $petugas->id)
            ->whereMonth('created_at', $bulanint)
            ->whereYear('created_at', $tahun)
            ->get()
            ->groupBy(function ($item) {
                if ($item->waktu_masuk == null) {
                    return 'absen';
                } else {
                    return 'hadir';
                }
            })
            ->map(function ($item) {
                return $item->count();
            });
        $data = [
            'petugasNama' => $petugas->name,
            'totalGaji' => number_format($gaji->total, 0, ',', '.'),
            'totalHadir' => $detailPresensi['hadir'] ?? 0,
            'totalAbsen' => $detailPresensi['absen'] ?? 0,
            'totalPotongan' => $gaji->potongan . '%',
            'bulanTahun' => $bulan . '/' . $tahun
        ];
        return response()->json($data, 200);
    }
    public function export(Request $request, $id)
    {

        $uuid = ($request->post('uuid')) ? $request->post('uuid') : '';
        $bulan = ($request->get('bulan'))
            ? $request->get('bulan') :
            Carbon::now()->locale('id')->getTranslatedMonthName();
        $tahun = ($request->get('tahun'))
            ? $request->get('tahun') : Carbon::now()->year;
        $bulanint = $this->bulan2int($bulan);
        $gaji = Gaji::find($id);
        $petugas = $gaji->petugas;
        $detailPresensi = Presensi::where('petugas_id', $petugas->id)
            ->whereMonth('created_at', $bulanint)
            ->whereYear('created_at', $tahun)
            ->get()
            ->groupBy(function ($item) {
                if ($item->waktu_masuk == null) {
                    return 'absen';
                } else {
                    return 'hadir';
                }
            })
            ->map(function ($item) {
                return $item->count();
            });
        $fileName = $uuid . '.pdf';
        $filelink = url('storage/slipgaji/' . $fileName);

        $data = [
            'timestamp' => Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y'),
            'nama' => $petugas->name,
            'bulanTahun' => $bulan . '/' . $tahun,
            'hadir' => $detailPresensi['hadir'] ?? 0,
            'absen' => $detailPresensi['absen'] ?? 0,
            'potongan' => $gaji->potongan . '%',
            'total' => number_format($gaji->total, 0, ',', '.'),
            'filelink' => $filelink,
            'qrcode' => $request->post('qrb64')
        ];

        $pdf = PDF::loadView('exports.slipgaji', [
            'data' => (object)$data
        ]);
        $content = $pdf->download()->getOriginalContent();
        Storage::disk('public')->put('slipgaji/' . $fileName, $content);
        return $pdf->stream();
    }
    public function bulan2int($date_string)
    {
        return strtr(
            strtolower($date_string),
            array(
                'januari' => 1,
                'februari' => 2,
                'maret' => 3,
                'april' => 4,
                'mei' => 5,
                'juni' => 6,
                'juli' => 7,
                'agustus' => 8,
                'september' => 9,
                'oktober' => 10,
                'november' => 11,
                'desember' => 12,
            )
        );
    }
}
