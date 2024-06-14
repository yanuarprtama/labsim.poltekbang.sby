<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\DetailPeminjamanInventaris;
use App\Models\Inventari;
use App\Models\PeminjamanInventari;

class DetailPeminjamanInventarisFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailPeminjamanInventaris::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'peminjaman_inventaris_id' => PeminjamanInventari::factory(),
            'inventaris_id' => Inventari::factory(),
            'dpi_qty' => $this->faker->word(),
        ];
    }
}
