<?php

namespace Database\Seeders;

use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Models\Product\ProductVariant;
use App\Models\Product\Property;
use App\Models\Product\Value;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Category::factory(5)->create();
        Property::factory(5)->create();
        Value::factory(5)->create();
        Product::factory(5)->create();
        ProductVariant::factory(5)->create();
        Product::factory(5)->create();
    }
}
