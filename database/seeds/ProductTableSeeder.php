<?php

use Illuminate\Database\Seeder;
use App\Product;
use Faker\Factory;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1, 5) as $index) {
        	Product::create([
        		'nama' => $faker->word,
        		'harga' => $faker->randomNumber(5),
        		'foto' => $faker->imageUrl($width = 200, $height = 100),
        		'created_at' => $faker->dateTime($max = 'now'),
        		'updated_at' => $faker->dateTime($max = 'now'),
        		'id_kategori' => '1'

        	]);
        }
    }
}
