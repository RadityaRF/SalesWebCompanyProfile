<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Hapus data lama (opsional)
        Admin::truncate();

        // Buat admin baru dengan password ter-hash
        Admin::create([
            'nama'     => 'Admin',
            'email'    => 'admin@xoxo.com',
            'password' => bcrypt('secret123'),
        ]);
        Admin::create([
            'nama'     => 'Raditya',
            'email'    => 'raditya@admin.com',
            'password' => bcrypt('Rizkaaml16#'),
        ]);
    }
}
