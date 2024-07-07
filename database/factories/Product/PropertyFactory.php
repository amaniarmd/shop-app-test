<?php

namespace Database\Factories\Product;

use App\Enums\Product\Entries;
use App\Enums\Product\Fields;
use App\Models\Product\Category;
use App\Models\Product\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product\Property>
 */
class PropertyFactory extends Factory
{
    protected $model = Property::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();

        return [
            Fields::NAME => $this->faker->randomElement(Entries::PROPERTY_NAMES),
            Fields::CATEGORY_ID => $category[Fields::ID],
        ];
    }
}
