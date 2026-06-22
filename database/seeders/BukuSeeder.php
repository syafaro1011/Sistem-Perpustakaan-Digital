<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;
use App\Models\Kategori;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = Kategori::all();

        Buku::factory(20)->create()->each(function ($buku) use ($kategoris) {
            // Attach 1-2 kategori secara acak (Many-to-Many)
            $buku->kategoris()->attach(
                $kategoris->random(rand(1, 2))->pluck('id')->toArray()
            );
        });
    }
}