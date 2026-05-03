<?php

namespace Database\Factories;
use App\Models\Divisi;
use App\Models\Karyawan;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karyawan>
 */
class KaryawanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'nama' => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'alamat' => $this->faker->address(),
            'tanggal_lahir' => $this->faker->date(),
            'posisi' => Divisi::factory(), // Membuat divisi secara otomatis
            'gaji' => $this->faker->randomFloat(2, 3000000, 15000000),
            'tanggal_masuk' => $this->faker->date(),
        ];
    }
}
