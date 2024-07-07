<?php

namespace Database\Factories\Product;

use App\Enums\Product\Fields;
use App\Models\Product\Property;
use App\Models\Product\Value;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product\Value>
 */
class ValueFactory extends Factory
{
    protected $model = Value::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $property = Property::inRandomOrder()->first();

        return [
            Fields::NAME => $this->faker->colorName,
            Fields::PROPERTY_ID => $property[Fields::ID],
        ];
    }
}
