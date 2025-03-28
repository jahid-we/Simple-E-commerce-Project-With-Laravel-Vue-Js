<?php

namespace Database\Seeders;

use App\Models\ProductDetail;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductDetail::insert([
            [
                'img1' => 'https://picsum.photos/800/400?random=99',
                'img2' => 'https://picsum.photos/800/400?random=98',
                'img3' => 'https://picsum.photos/800/400?random=97',
                'img4' => 'https://picsum.photos/800/400?random=94',
                'des' => 'High-quality product with excellent features.',
                'color' => 'Red',
                'size' => 'M',
                'product_id' => 1,
            ],
            [
                'img1' => 'https://picsum.photos/800/400?random=89',
                'img2' => 'https://picsum.photos/800/400?random=88',
                'img3' => 'https://picsum.photos/800/400?random=87',
                'img4' => 'https://picsum.photos/800/400?random=86',
                'des' => 'Premium quality item made for daily use.',
                'color' => 'Blue',
                'size' => 'L',
                'product_id' => 2,
            ],
            [
                'img1' => 'https://picsum.photos/800/400?random=79',
                'img2' => 'https://picsum.photos/800/400?random=78',
                'img3' => 'https://picsum.photos/800/400?random=77',
                'img4' => 'https://picsum.photos/800/400?random=76',
                'des' => 'Durable and stylish product for modern users.',
                'color' => 'Green',
                'size' => 'S',
                'product_id' => 3,
            ],
            [
                'img1' => 'https://picsum.photos/800/400?random=69',
                'img2' => 'https://picsum.photos/800/400?random=68',
                'img3' => 'https://picsum.photos/800/400?random=67',
                'img4' => 'https://picsum.photos/800/400?random=66',
                'des' => 'Lightweight and comfortable for everyday wear.',
                'color' => 'Black',
                'size' => 'XL',
                'product_id' => 4,
            ],
            [
                'img1' => 'https://picsum.photos/800/400?random=59',
                'img2' => 'https://picsum.photos/800/400?random=58',
                'img3' => 'https://picsum.photos/800/400?random=57',
                'img4' => 'https://picsum.photos/800/400?random=56',
                'des' => 'Trendy design with long-lasting materials.',
                'color' => 'Yellow',
                'size' => 'M',
                'product_id' => 5,
            ],
            [
                'img1' => 'https://picsum.photos/800/400?random=49',
                'img2' => 'https://picsum.photos/800/400?random=48',
                'img3' => 'https://picsum.photos/800/400?random=47',
                'img4' => 'https://picsum.photos/800/400?random=46',
                'des' => 'Perfect for formal and casual occasions.',
                'color' => 'White',
                'size' => 'S',
                'product_id' => 6,
            ],
            [
                'img1' => 'https://picsum.photos/800/400?random=39',
                'img2' => 'https://picsum.photos/800/400?random=38',
                'img3' => 'https://picsum.photos/800/400?random=37',
                'img4' => 'https://picsum.photos/800/400?random=36',
                'des' => 'Eco-friendly material with a modern look.',
                'color' => 'Brown',
                'size' => 'L',
                'product_id' => 7,
            ],
            [
                'img1' => 'https://picsum.photos/800/400?random=29',
                'img2' => 'https://picsum.photos/800/400?random=28',
                'img3' => 'https://picsum.photos/800/400?random=27',
                'img4' => 'https://picsum.photos/800/400?random=26',
                'des' => 'Comfortable, stylish, and easy to wear.',
                'color' => 'Gray',
                'size' => 'M',
                'product_id' => 8,
            ],
            [
                'img1' => 'https://picsum.photos/800/400?random=19',
                'img2' => 'https://picsum.photos/800/400?random=18',
                'img3' => 'https://picsum.photos/800/400?random=17',
                'img4' => 'https://picsum.photos/800/400?random=16',
                'des' => 'Designed for active and stylish individuals.',
                'color' => 'Purple',
                'size' => 'XL',
                'product_id' => 9,
            ],
            [
                'img1' => 'https://picsum.photos/800/400?random=9',
                'img2' => 'https://picsum.photos/800/400?random=8',
                'img3' => 'https://picsum.photos/800/400?random=7',
                'img4' => 'https://picsum.photos/800/400?random=6',
                'des' => 'Classic design with a touch of elegance.',
                'color' => 'Orange',
                'size' => 'L',
                'product_id' => 10,
            ],
        ]);
    }
}
