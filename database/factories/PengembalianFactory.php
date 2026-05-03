<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Peminjaman;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengembalian>
 */
class PengembalianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'peminjaman_id' => Peminjaman::factory(),
            'tanggal_pengembalian' => $this->faker->date(),
            'kondisi_barang' => $this->faker->randomElement(['baik', 'rusak', 'hilang']),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
