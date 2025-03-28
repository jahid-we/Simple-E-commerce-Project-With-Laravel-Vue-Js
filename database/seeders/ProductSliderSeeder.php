<?php

namespace Database\Seeders;

use App\Models\ProductSlider;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductSlider::create([
            'title' => 'Product One Slider',
            'short_des' => 'This is a great slider for product one, showcasing its top features.',
            'price' => '120.00',
            'image' => 'https://picsum.photos/1250/500?random=21',
            'product_id' => 1, // Assuming product with id 1 exists
        ]);

        ProductSlider::create([
            'title' => 'Product Two Slider',
            'short_des' => 'Check out this beautiful slider for product two, highlighting its unique design.',
            'price' => '150.00',
            'image' => 'https://picsum.photos/1250/500?random=22',
            'product_id' => 2, // Assuming product with id 2 exists
        ]);
        ProductSlider::create([
            'title' => 'Product Three Slider',
            'short_des' => 'Check out this beautiful slider for product two, highlighting its unique design.',
            'price' => '160.00',
            'image' => 'https://picsum.photos/1250/500?random=32',
            'product_id' => 3, // Assuming product with id 2 exists
        ]);
        ProductSlider::create([
            'title' => 'Product Four Slider',
            'short_des' => 'Check out this beautiful slider for product two, highlighting its unique design.',
            'price' => '350.00',
            'image' => 'https://picsum.photos/1250/500?random=42',
            'product_id' => 4, // Assuming product with id 2 exists
        ]);
        ProductSlider::create([
            'title' => 'Product Five Slider',
            'short_des' => 'Check out this beautiful slider for product two, highlighting its unique design.',
            'price' => '280.00',
            'image' => 'https://picsum.photos/1250/500?random=52',
            'product_id' => 5, // Assuming product with id 2 exists
        ]);
        ProductSlider::create([
            'title' => 'Product Six Slider',
            'short_des' => 'Check out this beautiful slider for product two, highlighting its unique design.',
            'price' => '260.00',
            'image' => 'https://picsum.photos/1250/500?random=62',
            'product_id' => 6, // Assuming product with id 2 exists
        ]);
        ProductSlider::create([
            'title' => 'Product Seven Slider',
            'short_des' => 'Check out this beautiful slider for product two, highlighting its unique design.',
            'price' => '260.00',
            'image' => 'https://picsum.photos/1250/500?random=72',
            'product_id' => 7, // Assuming product with id 2 exists
        ]);
        ProductSlider::create([
            'title' => 'Product Eight Slider',
            'short_des' => 'Check out this beautiful slider for product two, highlighting its unique design.',
            'price' => '560.00',
            'image' => 'https://picsum.photos/1250/500?random=79',
            'product_id' => 8, // Assuming product with id 2 exists
        ]);
        ProductSlider::create([
            'title' => 'Product Nine Slider',
            'short_des' => 'Check out this beautiful slider for product two, highlighting its unique design.',
            'price' => '500.00',
            'image' => 'https://picsum.photos/1250/500?random=80',
            'product_id' => 9, // Assuming product with id 2 exists
        ]);
    }
}
