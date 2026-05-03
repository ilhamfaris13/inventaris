<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Karyawan;
use App\Models\Barang;
use App\Models\Peminjaman;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peminjaman>
 */
class PeminjamanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'karyawan_id' => Karyawan::factory(),
            'barang_id' => Barang::factory(),
            'jumlah' => $this->faker->numberBetween(1, 5),
            'tanggal_pinjam' => $this->faker->date(),
            'tanggal_kembali' => $this->faker->optional()->date(),
            'status' => $this->faker->randomElement(['dipinjam', 'dikembalikan']),
        ];
    }
}
