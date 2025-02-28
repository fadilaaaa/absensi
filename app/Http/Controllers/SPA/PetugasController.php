<?php

namespace App\Http\Controllers\SPA;

use App\Models\Gaji;
use App\Models\Izin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

Carbon::setLocale('id');

class PetugasController extends \App\Http\Controllers\Controller
{
    public function store_image($image, $prefix)
    {
        $imageName = $prefix . '_' . time() . '.' . $image->getClientOriginalExtension();
        // Storage::disk('public')->put('imgpengaduan/' . $imageName, $image);
        $path = Storage::putFileAs('public/imgpengaduan', $image, $imageName);
        return $imageName;
    }
    public function getIzin(Request $request)
    {
        $user = auth('sanctum')->user();
        $izin = Izin::where('petugas_id', $user->petugas->id)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Data Izin',
            'data' => $izin
        ], 200);
    }
    public function storeIzin(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'jenisPengajuan' => 'required',
            'keterangan' => 'required',
        ]);
        $izin = Izin::create([
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenisPengajuan,
            'keterangan' => $request->keterangan,
            'petugas_id' => auth('sanctum')->user()->petugas->id,
        ]);
        if (!$izin) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to Add Data'
            ], 400);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Data Added Successfully'
        ], 200);
    }
    public function getPengaduan(Request $request)
    {
        $user = auth('sanctum')->user();
        $pengaduan = $user->petugas->pengaduan;
        return response()->json([
            'status' => 'success',
            'message' => 'Data Pengaduan',
            'data' => $pengaduan
        ], 200);
    }
    public function storePengaduan(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'required',
            'foto' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $pengaduan = new \App\Models\Pengaduan();
            $pengaduan->tanggal = $request->tanggal;
            $pengaduan->lokasi = $request->lokasi;
            $pengaduan->keterangan = $request->keterangan;
            $pengaduan->foto = $this->store_image($request->file('foto'), 'pengaduan');
            $pengaduan->petugas_id = auth('sanctum')->user()->petugas->id;
            $pengaduan->save();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Data Added Successfully'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to Add Data'
            ], 400);
        }
    }
    public function getGaji(Request $request)
    {
        $gaji = Gaji::where(
            'petugas_id',
            auth('sanctum')->user()->petugas->id
        )
            ->get()
            ->sortByDesc('created_at');
        $gaji = $gaji->map(function ($item) {
            $item->detil = $item->detail();
            return $item;
        });
        //      bulan: "Januari",
        //     gaji: "Rp 1.000.000",
        //     tahun: "2024",
        //     status: "Lunas",
        //     absen: 3,
        //     telat: 2,
        //     izin: 1,
        $gajiFormated = $gaji->map(function ($item) {
            return [
                'bulan' => Carbon::parse($item->tanggal)->translatedFormat('F'),
                'gaji' => 'Rp ' . number_format($item->gaji, 0, ',', '.'),
                'tahun' => Carbon::parse($item->tanggal)->translatedFormat('Y'),

                'absen' => $item->detil['totalAbsen'],
                'telat' => $item->detil['totalPotongan'],
                'izin' => $item->detil['totalIzin'],
            ];
        });
        return response()->json([
            'status' => 'success',
            'message' => 'Data Gaji',
            'data' => $gaji
        ], 200);
    }
}
