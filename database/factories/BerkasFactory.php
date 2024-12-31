<?php

namespace Database\Factories;

use App\Models\BerkasModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BerkasFactory extends Factory
{
    protected $model = BerkasModel::class;

    /**
     * Definisikan model untuk pembuatan data palsu.
     *
     * @return array
     */
    public function definition()
    {
        // Mengambil user secara acak dari tabel 'users'
        $user = User::inRandomOrder()->first();
        $bulanIndonesia = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];
        return [
            'user_id' => $user->id, // ID dari user yang dipilih secara acak
            'nama_user' => $user->nama, // Menggunakan nama user dari tabel users
            'nip' => $user->nip, // Menggunakan NIP user dari tabel users
            'kabupaten' => $user->kabupaten, // Kabupaten diambil dari tabel users
            'nama_instansi' => $user->nama_instansi, // Nama instansi diambil dari tabel users
            'tahun' => $this->faker->numberBetween(2020, 2024), // Tahun dibatasi dari 2020 sampai 2024
            'bulan' => $bulanIndonesia[$this->faker->monthName], // Mengonversi nama bulan ke bahasa Indonesia
            'npsn_sekolah' => $this->faker->optional()->numerify('###'), // NPSN sekolah bisa kosong
            'file_sptjm' => 'uploads/default.pdf',
            'file_skp' => 'uploads/default.pdf',
            'file_tpp' => 'uploads/default.pdf',
            'file_dhbpo' => 'uploads/default.pdf',
            'file_ekinerja' => 'uploads/default.pdf',
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'deadline' => $this->faker->optional()->date(), // Deadline bisa kosong
        ];
    }
}
