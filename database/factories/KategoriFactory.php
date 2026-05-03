<?php

namespace Database\Factories;
use App\Models\Divisi;
use App\Models\Kategori;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kategori>
 */
class KategoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_kategori' => $this->faker->unique()->word(),
            'deskripsi' => $this->faker->sentence(),
        ];
    }
}
