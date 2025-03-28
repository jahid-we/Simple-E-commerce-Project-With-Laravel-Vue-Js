<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['categoryName' => 'Electronics', 'categoryImg' => 'https://picsum.photos/800/400?random=51'],
            ['categoryName' => 'Fashion', 'categoryImg' => 'https://picsum.photos/800/400?random=52'],
            ['categoryName' => 'Home & Kitchen', 'categoryImg' => 'https://picsum.photos/800/400?random=53'],
            ['categoryName' => 'Health & Beauty', 'categoryImg' => 'https://picsum.photos/800/400?random=54'],
            ['categoryName' => 'Sports & Outdoors', 'categoryImg' => 'https://picsum.photos/800/400?random=55'],
            ['categoryName' => 'Toys & Games', 'categoryImg' => 'https://picsum.photos/800/400?random=56'],
            ['categoryName' => 'Automotive', 'categoryImg' => 'https://picsum.photos/800/400?random=57'],
            ['categoryName' => 'Books & Stationery', 'categoryImg' => 'https://picsum.photos/800/400?random=58'],
        ];

        Category::insert($categories);
    }
}
