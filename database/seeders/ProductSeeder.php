<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [];

        for ($i = 1; $i <= 30; $i++) {
            $products[] = [
                'title' => "Product $i",
                'short_des' => "Short description for Product $i.",
                'price' => rand(50, 500) . ".00",
                'discount' => rand(0, 1),
                'discount_price' => rand(50, 500) . ".00",
                'image' => "https://picsum.photos/800/400?random=$i",
                'stock' => rand(0, 1),
                'star' => round(mt_rand(30, 50) / 10, 1),
                'remark' => ['popular', 'new', 'top', 'regular', 'special', 'trending'][array_rand(['popular', 'new', 'top', 'regular', 'special', 'trending'])],
                'category_id' => rand(1, 5),
                'brand_id' => rand(1, 5),
            ];
        }

        Product::insert($products);
    }
}
