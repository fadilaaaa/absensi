<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }
    public function detail()
    {
        $detailPresensi = Presensi::where(
            'petugas_id',
            $this->petugas_id
        )->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->get()
            ->groupBy(
                function ($item) {
                    if ($item->waktu_masuk == null) {
                        return 'absen';
                    } else {
                        return 'hadir';
                    }
                }
            )->map(function ($item) {
                return $item->count();
            });
        $countIzin = $this->petugas->izin()
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();
        return [
            'totalHadir' => $detailPresensi['hadir'] ?? 0,
            'totalAbsen' => $detailPresensi['absen'] ?? 0,
            'totalPotongan' => $this->potongan . '%',
            'totalIzin' => $countIzin
        ];
    }
}
