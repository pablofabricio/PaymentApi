<?php

namespace App\Services\Payment;

use App\Repositories\PaymentRepository;

class PaymentService
{
    public function __construct(
        private PaymentRepository $paymentRepository
    ) {}

    public function all()
    {
        return $this->paymentRepository->all();
    }

    public function find(string $id)
    {
        return $this->paymentRepository->where('id', $id)->get();
    }

    public function destroy(string $id): void
    {
        $this->paymentRepository->delete($id);
    }

    public function confirmPayment(string $id): void
    {
        $this->paymentRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->paymentRepository->create($data);
    }
}
