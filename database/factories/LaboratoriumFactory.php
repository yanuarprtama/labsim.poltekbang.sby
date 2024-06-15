<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Laboratorium;
use App\Models\Prodi;

class LaboratoriumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Laboratorium::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $data = [
            'prodi_id' => Prodi::factory(),
            'l_nama' => $this->faker->unique()->word(),
            'l_jenis' => $this->faker->randomElement(["laboratorium", "simulator"]),
            'l_status' => $this->faker->randomElement(["aktif", "non_aktif"]),
        ];

        $data["l_slug"] = Str::slug($data["l_nama"]);

        return $data;
    }
}
