<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
        $product_name = $this->faker->words($nb=4,$asText=true);
        $slug = Str::of($product_name)->slug();

        return [
            'name' => $product_name,
            'slug' => $slug,
            'short_description' => $this->faker->text(100),
            'description' => $this->faker->text(500),
            'regular_price' => $this->faker->numberBetween(100,500),
            'SKU' => 'DIGI'.$this->faker->numberBetween(1,30),
            'stock_status' => 'instock',
            'quantity' => $this->faker->numberBetween(100,200),
            'image' => 'digital_'.$this->faker->numberBetween(1,22).'.jpg',
            'category_id' => $this->faker->numberBetween(1,5)

        ];
    }
}
