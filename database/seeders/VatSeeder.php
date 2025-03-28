<?php

namespace Database\Seeders;

use App\Models\Vat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vat::create([
            'vat_percentage' => '5 %', // Example VAT percentage
        ]);
    }
}
