<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        $product = Product::inRandomOrder()->first();
        $total_amount = $this->faker->randomNumber(4);
        $discount = $total_amount * ($this->faker->randomDigit / 10);
        $fees = $total_amount * ($this->faker->randomDigit / 50);
        $date = $this->faker->dateTimeBetween('-2 years');

        return [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'total_amount' => $total_amount,
            'discount' => $discount,
            'fees' => $fees,
            'is_refunded' => $this->faker->randomElement([0, 1]),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
