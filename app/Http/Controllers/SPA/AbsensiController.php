<?php

namespace App\Http\Controllers\SPA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Presensi;

class AbsensiController extends Controller
{
    function storeImage($request, $prefix)
    {
        $image_64 = $request->subIm;
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
        $image = str_replace($replace, '', $image_64);
        $image = str_replace(' ', '+', $image);
        // $imageName = Str::random(10) . '.' . $extension;
        $imageName = $prefix . time() . '.' . $extension;
        // $request->subIm->storeAs('imgpres', $imageName);
        Storage::disk('public')->put('imgpres/' . $imageName, base64_decode($image));
        return $imageName;
    }
    public function getTodayPresensi(Request $request)
    {
        $todayPresensi = Presensi::where('petugas_id', auth('sanctum')->user()->petugas->id)
            ->whereDate('created_at', date('Y-m-d'))
            ->first();
        if (!$todayPresensi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Presensi not found'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Today Presensi',
            'data' => $todayPresensi
        ], 200);
    }
    public function absen(Request $request)
    {
        try {
            $request->validate([
                'subIm' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $th) {
            return response()->json(['status' => 'error', 'message' => 'Image Required'], 400);
        }
        $todayPresensi = Presensi::where('petugas_id', auth('sanctum')->user()->petugas->id)
            ->whereDate('created_at', date('Y-m-d'))
            ->first();

        // user has not absen masuk
        if ($todayPresensi) {
            if ($todayPresensi->waktu_masuk == null) {
                $imageName = $this->storeImage($request, 'masuk_');
                $todayPresensi->update([
                    'waktu_masuk' => date('H:i:s'),
                    'bukti_masuk' => 'imgpres/' . $imageName,
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Absen Masuk Success'
                ], 200);
            }
        }
        //  user has absen masuk but not absen keluar
        $imageName = $this->storeImage($request, 'keluar_');
        $todayPresensi->update([
            'waktu_keluar' => date('H:i:s'),
            'bukti_keluar' => 'imgpres/' . $imageName,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Absen Keluar Success'
        ], 200);
    }
    public function getRiwayatPresensi(Request $request)
    {
        $bulan = ($request->get('bulan'))
            ? $request->get('bulan')
            : date('m');
        $tahun = ($request->get('tahun'))
            ? $request->get('tahun') : date('Y');
        $riwayatPresensi = Presensi::where(
            'petugas_id',
            auth('sanctum')->user()->petugas->id
        )
            ->whereNotNull('waktu_masuk')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Riwayat Presensi',
            'data' => $riwayatPresensi
        ], 200);
    }
}
