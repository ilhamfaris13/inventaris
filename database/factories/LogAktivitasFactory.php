<?php

namespace Database\Factories;
use App\Models\Karyawan;
use App\Models\LogAktivitas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LogAktivitas>
 */
class LogAktivitasFactory extends Factory
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
            'aktivitas' => $this->faker->sentence(),
            'timestamp' => now(),
        ];
    }
}
