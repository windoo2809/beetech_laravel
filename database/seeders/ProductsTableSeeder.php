<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<50; $i++){
            $product = new Product();
            $product->name = fake()->unique()->name;
            $product->sku = fake()->unique()->name;
            $product->stock = fake()->numberBetween(1,500);
            $product->expired_at = fake()->date;
            $product->category_id  = fake()->numberBetween(1,2);
            $product->avatar = fake()->imageUrl($width = 200, $height = 200);
            $product->save();
        }
    }
}
