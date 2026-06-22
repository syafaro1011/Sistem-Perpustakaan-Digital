<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Kategori>
 */
class KategoriFactory extends Factory
{
    public function definition(): array
    {
        $kategoris = ['Novel', 'Sains', 'Teknologi', 'Sejarah', 'Biografi', 'Agama', 'Anak-anak'];
        return [
            'nama_kategori' => $this->faker->unique()->randomElement($kategoris),
            'deskripsi' => $this->faker->sentence(),
        ];
    }
}
