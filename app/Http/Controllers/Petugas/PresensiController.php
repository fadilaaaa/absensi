<?php

namespace App\Http\Controllers\Petugas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Presensi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PresensiController extends \App\Http\Controllers\Controller
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
    public function index(Request $request)
    {
        $todayPresensi = Presensi::where('petugas_id', Auth::user()->petugas->id)
            ->whereDate('created_at', date('Y-m-d'))
            ->first();
        return view('petugas.presensi', compact('todayPresensi'));
    }
    public function absen(Request $request)
    {
        try {
            $request->validate([
                'subIm' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $th) {
            return response()->json(['status' => 'error', 'message' => 'Image Required'], 500);
        }
        DB::beginTransaction();
        try {
            $todayPresensi = Presensi::where('petugas_id', Auth::user()->petugas->id)
                ->whereDate('created_at', date('Y-m-d'))
                ->first();
            if ($todayPresensi) {
                if ($todayPresensi->waktu_masuk == null) {
                    $imageName = $this->storeImage($request, 'masuk_');
                    $todayPresensi->update([
                        'waktu_masuk' => date('H:i:s'),
                        'bukti_masuk' => 'imgpres/' . $imageName,
                    ]);
                    DB::commit();
                    return response()->json(['status' => 'success', 'message' => 'Data Added Successfully', 'img' => $imageName], 200);
                }
                $imageName = $this->storeImage($request, 'keluar_');
                $todayPresensi->update([
                    'waktu_keluar' => date('H:i:s'),
                    'bukti_keluar' => 'imgpres/' . $imageName,
                ]);
                DB::commit();
                return response()->json(['status' => 'success', 'message' => 'Data Added Successfully', 'img' => $imageName], 200);
            }
            $imageName = $this->storeImage($request, 'masuk_');
            $todayPresensi = Presensi::create([
                'petugas_id' => Auth::user()->petugas->id,
                'waktu_masuk' => date('H:i:s'),
                'bukti_masuk' => 'imgpres/' . $imageName,
            ]);
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Data Added Successfully', 'img' => $imageName], 200);
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
            return response()->json(['status' => 'error', 'message' => 'Data Added Failed'], 500);
        }
    }
    public function riwayat($id)
    {
        $presensi = Presensi::where('petugas_id', Auth::user()->petugas->id)
            ->whereNotNull('waktu_masuk')
            ->orderBy('created_at', 'desc')->get();
        return view('petugas.presensiRiwayat', compact('presensi'));
    }
}
