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
        $data = [
            'p_nama' => $this->faker->word(),
            'p_kode' => $this->faker->word(),
            'status' => $this->faker->randomElement(["aktif", "non_aktif"]),
        ];

        $data["p_slug"] = Str::slug($data["p_nama"]);

        return $data;
    }
}
