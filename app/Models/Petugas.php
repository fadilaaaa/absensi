<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
    public function izin()
    {
        return $this->hasMany(Izin::class);
    }
    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }
    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class);
    }
    public function getPotonganGajiBulanIni()
    {
        return $this->presensi()->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->where('waktu_masuk', null)
            ->count() * 1.5;
    }
}
