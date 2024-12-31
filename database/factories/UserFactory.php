<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'nip' => $this->faker->unique()->nik(), // Contoh NIP
            'level' => $this->faker->randomElement(['admin', 'user']),
            'status' => $this->faker->randomElement(['aktif', 'non-aktif']),
            'password' => bcrypt('password'), // password default
            'kabupaten' => $this->faker->randomElement([
                'Banyuasin',
                'Empat Lawang',
                'Lahat',
                'Lubuk Linggau',
                'Muara Enim',
                'Musi Banyuasin',
                'Musi Rawas',
                'Ogan Ilir',
                'Ogan Komering Ilir',
                'Ogan Komering Ulu',
                'Palembang',
                'Pagar Alam',
                'Prabumulih',
            ]), // Menggunakan daftar kabupaten yang telah ditentukan
            'nama_instansi' => $this->faker->company,
            'notel' => $this->faker->randomNumber(),
            'birthday' => $this->faker->date(),
            'tanggal_registrasi' => $this->faker->dateTimeThisDecade(),
        ];
    }
}
