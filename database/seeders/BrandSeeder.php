<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['brandName' => 'Brand One', 'brandImg' => 'https://picsum.photos/800/400?random=66'],
            ['brandName' => 'Brand Two', 'brandImg' => 'https://picsum.photos/800/400?random=26'],
            ['brandName' => 'Brand Three', 'brandImg' => 'https://picsum.photos/800/400?random=36'],
            ['brandName' => 'Brand Four', 'brandImg' => 'https://picsum.photos/800/400?random=46'],
            ['brandName' => 'Brand Five', 'brandImg' => 'https://picsum.photos/800/400?random=56'],
            ['brandName' => 'Brand Six', 'brandImg' => 'https://picsum.photos/800/400?random=88'],
            ['brandName' => 'Brand Seven', 'brandImg' => 'https://picsum.photos/800/400?random=76'],
            ['brandName' => 'Brand Eight', 'brandImg' => 'https://picsum.photos/800/400?random=86'],
        ];

        Brand::insert($brands);
    }
}
