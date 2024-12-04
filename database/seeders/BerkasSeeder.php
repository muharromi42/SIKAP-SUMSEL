<?php

namespace Database\Seeders;

use App\Models\BerkasModel;
use Illuminate\Database\Seeder;

class BerkasSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     *
     * @return void
     */
    public function run()
    {
        // Buat 50 data berkas menggunakan factory
        \Database\Factories\BerkasFactory::new()->count(500)->create();
    }
}
