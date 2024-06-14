<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Prodi;

class ProdiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prodi::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'p_nama' => $this->faker->word(),
            'p_kode' => $this->faker->word(),
            'status' => $this->faker->randomElement(["aktif","non_aktif"]),
        ];
    }
}
