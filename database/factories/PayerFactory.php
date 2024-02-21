<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payer>
 */
class PayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'entity_type' => $this->faker->randomElement(['individual', 'company']),
            'type' => $this->faker->randomElement(['customer', 'merchant']),
            'email' => $this->faker->unique()->safeEmail,
            'identification_type' => $this->faker->randomElement(['CPF', 'CNPJ']),
            'identification_number' => $this->faker->unique()->numerify('##############'),
        ];
    }
}
