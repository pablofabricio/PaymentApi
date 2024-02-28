<?php

namespace App\Services\Payment;

use Illuminate\Support\Str;
use App\Repositories\PayerRepository;
use App\Repositories\PaymentRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    public function __construct(
        private PaymentRepository $paymentRepository,
        private PayerRepository $payerRepository,
    ) {}

    public function all()
    {
        return $this->paymentRepository->with('payer')->get();
    }

    public function find(string $id)
    {
        $payment = $this->paymentRepository
            ->with('payer')
            ->where('id', $id)
            ->first();
        
        if (empty($payment)) {
            throw new \Exception("Payment not found with the specified id", 404);
        }

        return $payment;
    }

    public function destroy(string $id): void
    {
        $payment = $this->paymentRepository->where('id', $id)->first();
        
        if (empty($payment)) {
            throw new \Exception("Payment not found with the specified id", 404);
        }

        $this->paymentRepository->update(['status' => 'CANCELED'], $id);;
    }

    public function confirmPayment(array $data, string $id): void
    {
        $payment = $this->paymentRepository->where('id', $id)->first();
        
        if (empty($payment)) {
            throw new \Exception("Bankslip not found with the specified id", 404);
        }

        $this->paymentRepository->update(['status' => $data['status']], $id);
    }

    public function create(array $data)
    {
        if (empty($data)) {
            throw new \Exception("payment not provided in the request body", 400);
        }

        DB::beginTransaction();

        try {
            $payer = $this->createPayer($data['payer']);

            $payment = $this->paymentRepository->create([
                'id' => Str::uuid()->toString(),
                'transaction_amount' => $data['transaction_amount'],
                'installments' => $data['installments'],
                'token' => $data['token'],
                'payer_id' => $payer->id,
                'payment_method_id' => $data['payment_method_id'],
                'notification_url' => 'https://webhook.site',
                'status' => 'PENDING'
            ]);
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            throw new \Exception('Invalid payment provided.The possible reasons are: A field of the provided payment was null or with invalid values', 422);
        }

        return [
            "id" => $payment->id,
            "created_at" => $payment->created_at
        ];
    }

    private function createPayer(array $data) 
    {
        $identificationNumber = preg_replace("/[^0-9]/", "", $data['identification']['number']);

        $payer = $this->payerRepository->where('identification_number', $identificationNumber)->first();

        if (!empty($payer)) {
            return $payer;
        }

        return $this->payerRepository->create([
            'entity_type' => 'individual',
            'type' => 'customer',
            'email' => $data['email'],
            'identification_type' => $data['identification']['type'], 
            'identification_number' => $identificationNumber,
        ]);
    }
}
