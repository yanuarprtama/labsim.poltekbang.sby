<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Laboratorium;
use App\Models\PeminjamanLaboratorium;
use App\Models\User;

class PeminjamanLaboratoriumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PeminjamanLaboratorium::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'pl_nomor_peminjaman' => $this->faker->word(),
            'pl_mata_kuliah' => $this->faker->text(),
            'pl_jenis_kegiatan' => $this->faker->randomElement(["penelitian","praktikum"]),
            'pl_jam_mulai' => $this->faker->time(),
            'pl_jam_akhir' => $this->faker->time(),
            'pl_dosen_pengajar' => $this->faker->word(),
            'pl_status' => $this->faker->randomElement(["DITERIMA","KADALUARSA","DITOLAK","DIBATALKAN","DIKEMBALIKAN"]),
            'laboratorium_id' => Laboratorium::factory(),
            'user_id' => User::factory(),
        ];
    }
}
