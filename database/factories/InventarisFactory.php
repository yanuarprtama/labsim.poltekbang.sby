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
        return [
            'a_nama' => $this->faker->word(),
            'a_kode' => $this->faker->word(),
            'a_stok' => $this->faker->word(),
            'a_status' => $this->faker->randomElement(["tersedia","tidak"]),
            'laboratorium_id' => Laboratorium::factory(),
        ];
    }
}
