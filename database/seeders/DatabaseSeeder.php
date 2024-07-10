<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        \App\Models\User::create([
            'id' => 1,
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);
        \App\Models\Petugas::create([
            'name' => 'Anisa Pohan',
            'nik' => '1234567890',
            'email' => 'asdasd@as.com',
            'alamat' => 'Jl. Jalan',
            'tgl_lahir' => '1999-09-09',
            'no_telp' => '081234567890',
            'is_admin' => true,
            'user_id' => 1,
        ]);
        for ($i = 2; $i < 100; $i++) {
            if ($i == 2) {
                $userName = 'user';
            } else {
                $userName = $faker->userName;
            }
            $user = \App\Models\User::create([
                'id' => $i,
                'username' => $userName,
                'password' => bcrypt('user'),
            ]);
            $petugas = \App\Models\Petugas::create([
                'name' => $faker->name,
                'nik' => $faker->nik,
                'email' => $faker->email,
                'alamat' => $faker->address,
                'tgl_lahir' => $faker->date,
                'no_telp' => $faker->phoneNumber,
                'is_admin' => false,
                'user_id' => $user->id,
            ]);
            $jadwal = \App\Models\Jadwal::create([
                'id' => $i,
                'periode' => $faker->randomElement(['Januari-Mei', 'Juni-Desember']),
                'lokasi' => $faker->address(),
                'waktu' => $faker->randomElement(['07:00-09:00', '09:00-11:00', '13:00-15:00']),
                'hari' => $faker->randomElement(['Senin-jumat', 'Sabtu-Minggu']),
                'petugas_id' => $petugas->id,
            ]);
            \App\Models\Izin::create([
                'petugas_id' => $user->id,
                'tanggal' => date('Y-m-d'),
                'jenis' => 'Sakit',
                'keterangan' => 'Operasi mata',
                'status' => 'disetujui',
            ]);
            \App\Models\Izin::create([
                'petugas_id' => $user->id,
                'tanggal' => date("Y-m-d", strtotime("+1 day")),
                'jenis' => 'Cuti',
                'keterangan' => 'Pulang kampung',
            ]);
            $bulantanggal = CarbonPeriod::create(Carbon::now()->subMonth(3)->startOfMonth(), Carbon::now())->toArray();
            foreach ($bulantanggal as $tanggal) {
                $jadwalHari = $jadwal->hari;
                $jadwalHari = explode('-', $jadwalHari);
                $daysOfWeek = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
                $jadwalHari = array_map(function ($hari) use ($daysOfWeek) {
                    return array_search($hari, $daysOfWeek);
                }, $jadwalHari);
                $date = Carbon::parse($tanggal)->locale('id');
                if ($date->dayOfWeek >= $jadwalHari[0] || $date->dayOfWeek <= $jadwalHari[1]) {
                    $bmasuk = $faker->randomElement(['imgpres/1.jpg', null]);

                    if ($bmasuk == null) {
                        $bkeluar = null;
                        $wkeluar = null;
                        $wmasuk = null;
                    } else {
                        $wmasuk = date('H:i:s');
                        $bkeluar = $faker->randomElement(['imgpres/1.jpg', null]);
                        $wkeluar = $faker->randomElement([date('H:i:s'), null]);
                    }
                    \App\Models\Presensi::create([
                        'petugas_id' => $user->id,
                        'bukti_masuk' => $bmasuk,
                        'waktu_masuk' => $wmasuk,
                        'bukti_keluar' => $bkeluar,
                        'waktu_keluar' => $wkeluar,
                        'created_at' => strtotime($tanggal),
                    ]);
                }
            }
            $baseGaji = 2500000;
            \App\Models\Gaji::create([
                'petugas_id' => $user->id,
                'gaji' => $baseGaji,
                'potongan' => $petugas->getPotonganGajiBulanIni(),
                'total' => $baseGaji - ($baseGaji * $petugas->getPotonganGajiBulanIni() / 100),
            ]);
            \App\Models\Pengaduan::create([
                'petugas_id' => $user->id,
                'tanggal' => date('Y-m-d'),
                'lokasi' => $faker->address,
                'keterangan' => $faker->sentence,
                'foto' => 'ex.jpg',
            ]);
        }
    }
}
