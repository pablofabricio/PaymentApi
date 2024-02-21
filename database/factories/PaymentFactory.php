<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'transaction_amount' => $this->faker->randomFloat(2, 10, 1000),
            'installments' => $this->faker->numberBetween(1, 12),
            'token' => $this->faker->uuid,
            'payer_id' => function () {
                return \App\Models\Payer::factory()->create()->id;
            },
            'payment_method_id' => $this->faker->uuid,
            'notification_url' => $this->faker->url,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
