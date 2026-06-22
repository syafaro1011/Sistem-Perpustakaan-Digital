<?php

namespace Database\Factories;

use App\Models\Buku;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_buku' => 'BK-' . $this->faker->unique()->numerify('####'),
            'judul' => $this->faker->sentence(4),
            'penulis' => $this->faker->name(),
            'penerbit' => $this->faker->company(),
            'tahun_terbit' => $this->faker->year(),
            'stok' => $this->faker->numberBetween(1, 20),
            'isbn' => $this->faker->isbn13(),
            'sinopsis' => $this->faker->paragraph(),
        ];
    }
}
