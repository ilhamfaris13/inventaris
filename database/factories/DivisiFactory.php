<?php

namespace Database\Factories;
use App\Models\Divisi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Divisi>
 */
class DivisiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kode_divisi' => strtoupper($this->faker->unique()->lexify('DIV???')),
            'nama_divisi' => $this->faker->jobTitle(),
            'deskripsi' => $this->faker->sentence(),
        ];
    }
}
