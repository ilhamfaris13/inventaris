<?php

namespace Database\Factories;
use App\Models\Barang;
use App\Models\Divisi;
use App\Models\Kategori;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'kode_barang' => strtoupper($this->faker->unique()->lexify('BRG???')),
            'nama_barang' => $this->faker->word(),
            'kategori_id' => Kategori::factory(),
            'spesifikasi' => $this->faker->sentence(),
            'jumlah' => $this->faker->numberBetween(1, 100),
            'kondisi' => $this->faker->randomElement(['baik', 'rusak', 'diperbaiki']),
            'lokasi' => $this->faker->city(),
            'kepemilikan_id' => Divisi::factory(),
            'tanggal_masuk' => $this->faker->date(),
        ];
    }
}
