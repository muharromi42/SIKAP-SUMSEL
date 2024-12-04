<?php

namespace Database\Factories;

use App\Models\BerkasModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berkas>
 */
class BerkasFactory extends Factory
{
    protected $model = BerkasModel::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id, // Mengambil user acak
            'nama_user' => $this->faker->name, // Nama acak
            'nip' => $this->faker->unique()->numerify('##########'), // NIP acak
            'tahun' => $this->faker->year, // Tahun acak
            'bulan' => $this->faker->monthName, // Bulan acak
            'kabupaten' => $this->faker->city, // Nama kabupaten acak
            'npsn_sekolah' => $this->faker->unique()->numerify('NPSN####'), // NPSN acak
            'nama_instansi' => $this->faker->company, // Nama instansi acak
            'file_sptjm' => 'file_sptjm_' . $this->faker->uuid . '.pdf', // Nama file SPTJM acak
            'file_skp' => 'file_skp_' . $this->faker->uuid . '.pdf', // Nama file SKP acak
            'file_tpp' => 'file_tpp_' . $this->faker->uuid . '.pdf', // Nama file TPP acak
            'file_dhbpo' => 'file_dhbpo_' . $this->faker->uuid . '.pdf', // Nama file DHBPO acak
            'file_ekinerja' => 'file_ekinerja_' . $this->faker->uuid . '.pdf', // Nama file E-Kinerja acak
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']), // Status acak
        ];
    }
}
