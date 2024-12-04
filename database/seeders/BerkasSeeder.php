<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BerkasModel;

class BerkasSeeder extends Seeder
{
    public function run()
    {
        // Menggunakan factory untuk membuat 50 entri data berkas
        BerkasModel::factory()->count(50)->create();
    }
}
