<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Inventaris;
use App\Models\Laboratorium;

class InventarisFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Inventaris::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $data = [
            'laboratorium_id' => Laboratorium::factory(),
            'a_nama' => $this->faker->unique()->word(),
            'a_kode' => $this->faker->numberBetween(1, 99),
            'a_stok' => $this->faker->numberBetween(1, 99),
            'a_status' => $this->faker->randomElement(["tersedia", "tidak"]),
        ];

        return $data;
    }
}
