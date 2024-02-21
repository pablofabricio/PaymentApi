<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentsData = [
            [
                'id' => "84e8adbf-1a14-403b-ad73-d78ae19b59bf",
                'transaction_amount' => 100.00,
                'installments' => 1,
                'token' => 'token1',
                'payer_id' => 1,
                'payment_method_id' => 'method1',
                'notification_url' => 'http://example.com/notification',
                'status' => 'pending',
            ],
            [
                'id' => "85e8adbf-1a14-403b-ad73-d78ae19b59bg",
                'transaction_amount' => 150.00,
                'installments' => 2,
                'token' => 'token2',
                'payer_id' => 2,
                'payment_method_id' => 'method2',
                'notification_url' => 'http://example.com/notification',
                'status' => 'approved',
            ],
        ];

        foreach ($paymentsData as $paymentData) {
            Payment::create($paymentData);
        }
    }
}
