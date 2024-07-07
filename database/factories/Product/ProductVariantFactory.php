<?php

namespace Database\Factories\Product;

use App\Enums\Product\Fields;
use App\Models\Product\Product;
use App\Models\Product\ProductVariant;
use App\Models\Product\Property;
use App\Models\Product\Value;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();
        $value = Value::inRandomOrder()->first();

        return [
            Fields::PRODUCT_ID => $product[Fields::ID],
            Fields::VALUE_ID => $value[Fields::ID],
            Fields::PRICE => $this->faker->randomFloat(2, 10, 100),
            Fields::STOCK => $this->faker->numberBetween(1, 100),
        ];
    }
}
