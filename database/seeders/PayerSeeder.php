<?php

namespace Database\Seeders;

use App\Models\Payer;
use Illuminate\Database\Seeder;

class PayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payersData = [
            [
                'entity_type' => 'individual',
                'type' => 'customer',
                'email' => 'customer1@example.com',
                'identification_type' => 'CPF',
                'identification_number' => '12345678901',
            ],
            [
                'entity_type' => 'individual',
                'type' => 'customer',
                'email' => 'customer2@example.com',
                'identification_type' => 'CPF',
                'identification_number' => '98765432109',
            ],
        ];

        foreach ($payersData as $payerData) {
            Payer::create($payerData);
        }
    }
}
