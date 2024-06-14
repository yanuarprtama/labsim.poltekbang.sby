<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PeminjamanInventaris;
use App\Models\User;

class PeminjamanInventarisFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PeminjamanInventaris::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'pi_nomor_peminjaman' => $this->faker->word(),
            'pi_jam_mulai' => $this->faker->time(),
            'pi_jam_akhir' => $this->faker->time(),
            'pi_status' => $this->faker->randomElement(["DITERIMA","KADALUARSA","DITOLAK","DIBATALKAN","DIKEMBALIKAN"]),
            'user_id' => User::factory(),
        ];
    }
}
