<?php

namespace Database\Factories\Product;

use App\Enums\Product\Entries;
use App\Enums\Product\Fields;
use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Models\Product\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();
        $productVariant = [
            Fields::PRICE => $this->faker->randomFloat(2, 10, 100),
            Fields::STOCK => $this->faker->numberBetween(1, 100),
        ];

        if(ProductVariant::all()->count() != 0){
            $productVariant = ProductVariant::inRandomOrder()->first();
        }

        return [
            Fields::NAME => $this->faker->randomElement(Entries::PRODUCT_NAMES),
            Fields::CATEGORY_ID => $category[Fields::ID],
            Fields::PRICE => $productVariant[Fields::PRICE],
            Fields::STOCK =>$productVariant[Fields::STOCK],
        ];
    }
}
