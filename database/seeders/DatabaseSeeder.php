<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        for ($i = 2; $i < 11; $i++) {
            $user = \App\Models\User::create([
                'id' => $i,
                'username' => $faker->userName,
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
            \App\Models\Presensi::create([
                'petugas_id' => $user->id,
                'bukti_masuk' => 'imgpres/ex.png',
                'waktu_masuk' => date('H:i:s'),
                'bukti_keluar' => 'imgpres/ex.png',
                'waktu_keluar' => date('H:i:s', time() + 60 * 60 * 10),
            ]);
            \App\Models\Presensi::create([
                'petugas_id' => $user->id,
                'bukti_masuk' => 'imgpres/ex.png',
                'waktu_masuk' => date('H:i:s'),
                'bukti_keluar' => 'imgpres/ex.png',
                'waktu_keluar' => date('H:i:s', time() + 60 * 60 * 10),
                'created_at' => date("Y-m-d H:i:s", strtotime("-1 day")),
            ]);
        }
    }
}
