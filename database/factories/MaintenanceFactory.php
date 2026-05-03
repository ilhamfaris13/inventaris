<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Barang;
use App\Models\Karyawan;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MaintenanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'barang_id' => Barang::factory(),
            'teknisi_id' => Karyawan::factory(),
            'tanggal_perbaikan' => $this->faker->date(),
            'deskripsi' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['diperbaiki', 'selesai']),
        ];
    }
}
