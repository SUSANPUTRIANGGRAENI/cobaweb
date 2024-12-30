<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Produk::create([
                'nama' => $faker->word(), 
                'kategori' => $faker->randomElement(['Elektronik', 'Minuman', 'Makanan', 'Mainan']), 
                'harga' => $faker->numberBetween(5000, 100000), 
                'stok' => $faker->numberBetween(1, 100), 
            ]);
        }
    }
}
