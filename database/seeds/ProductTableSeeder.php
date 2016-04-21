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
        		'nama' => word,
        		'harga' => randomNumber(5),
        		'foto' => imageUrl($width = 100, $height = 100),
        		'created_at' => dateTime($max = 'now'),
        		'updated_at' => dateTime($max = 'now'),
        		'id_kategoris' => 1

        	]);
        }
    }
}
