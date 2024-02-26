<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'entity_type' => 'individual',
            'type' => 'customer',
            'email' => Str::random(10) . '@example.com',
            'identification_type' => 'CPF',
            'identification_number' => mt_rand(10000000000, 99999999999),
        ];
    }
}
