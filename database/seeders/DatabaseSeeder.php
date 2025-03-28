<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\VatSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\BrandSeeder;
use Database\Seeders\PolicySeeder;
use Database\Seeders\InvoiceSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductCartSeeder;
use Database\Seeders\ProductWishSeeder;
use Database\Seeders\ProductDetailSeeder;
use Database\Seeders\ProductReviewSeeder;
use Database\Seeders\ProductSliderSeeder;
use Database\Seeders\InvoiceProductSeeder;
use Database\Seeders\CustomerProfileSeeder;
use Database\Seeders\SslcommerzAccountSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            CustomerProfileSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            ProductReviewSeeder::class,
            ProductDetailSeeder::class,
            ProductSliderSeeder::class,
            ProductWishSeeder::class,
            ProductCartSeeder::class,
            InvoiceSeeder::class,
            InvoiceProductSeeder::class,
            PolicySeeder::class,
            SslcommerzAccountSeeder::class,
            VatSeeder::class,
        ]);

    }
}
