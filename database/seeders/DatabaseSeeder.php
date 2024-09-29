<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        DB::table('audits')->insert([
            'date' => '2022-01-01',
            'title' => 'Keuangan Negara',
            'description' => 'Keuangan negara sedang gonjang-ganjing'
        ]);
        DB::table('audits')->insert([
            'date' => '2024-04-11',
            'title' => 'Keuangan RT',
            'description' => 'Pengeluaran besar-besaran sewa jet pribadi'
        ]);
    }
}
