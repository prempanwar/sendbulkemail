<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' =>  $this->faker->word,
            'description' => $this->faker->realText(200),
            'brand_name' => $this->faker->words(2, true),
            'sku_number' => $this->faker->unique()->numerify('ABC###'),
            'supplier_name' => $this->faker->name(),
            'product_weight' => $this->faker->randomDigitNotNull(),
            'status' => 1,
            'main_image' => 'http://lorempixel.com/800/600/sports/',
            'thumb_image' => 'http://lorempixel.com/250/125/sports/',
            'short_thumb_image' => 'http://lorempixel.com/100/100/sports/',
        ];
    }
}
