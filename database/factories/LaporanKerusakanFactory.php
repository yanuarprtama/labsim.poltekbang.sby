<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\LaporanKerusakan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LaporanKerusakanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LaporanKerusakan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => User::factory(),
            "lk_lampiran" => $this->faker->word(),
            "lk_keterangan" => $this->faker->text(),
        ];
    }
}
