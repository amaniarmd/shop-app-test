<?php

namespace Database\Factories\Product;

use App\Enums\Product\Entries;
use App\Enums\Product\Fields;
use App\Models\Product\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            Fields::NAME => $this->faker->randomElement(Entries::CATEGORY_NAMES),
        ];
    }
}
