<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * AdminSeeder — membuat akun administrator default
 *
 * Jalankan dengan:
 *   php artisan db:seed --class=AdminSeeder
 */
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus akun lama jika ada (idempotent)
        DB::table('users')->where('email', 'admin@labcbt.fkuht.ac.id')->delete();

        DB::table('users')->insert([
            'name'              => 'Administrator Lab CBT',
            'email'             => 'admin@labcbt.fkuht.ac.id',
            'password'          => Hash::make('LabCBT@2024'),
            'email_verified_at' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        // Akun operator (hak akses sama, bisa ditambah role nanti)
        DB::table('users')->where('email', 'operator@labcbt.fkuht.ac.id')->delete();
        DB::table('users')->insert([
            'name'              => 'Operator Lab CBT',
            'email'             => 'operator@labcbt.fkuht.ac.id',
            'password'          => Hash::make('Operator@2024'),
            'email_verified_at' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        $this->command->info('✅ Akun berhasil dibuat:');
        $this->command->table(
            ['Email', 'Password', 'Nama'],
            [
                ['admin@labcbt.fkuht.ac.id',    'LabCBT@2024',    'Administrator Lab CBT'],
                ['operator@labcbt.fkuht.ac.id', 'Operator@2024',  'Operator Lab CBT'],
            ]
        );
        $this->command->warn('⚠  Segera ganti password setelah login pertama!');
    }
}
