<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\KritikSaranInventaris;
use App\Models\PeminjamanInventaris;

class KritikSaranInventarisFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = KritikSaranInventaris::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'peminjaman_inventaris_id' => PeminjamanInventaris::factory(),
            'ks_kritik' => $this->faker->text(),
            'ks_saran' => $this->faker->text(),
        ];
    }
}
