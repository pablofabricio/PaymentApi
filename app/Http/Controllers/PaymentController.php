<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payment\PostPayment;
use App\Services\Payment\PaymentService;

class PaymentController
{
    public function __construct(
        private PaymentService $service
    ) {}

    public function all()
    {
        return response()->json($this->service->all());
    }

    public function find(string $id)
    {
        return response()->json($this->service->find($id));
    }
    
    public function destroy(string $id)
    {
        $this->service->destroy($id);

        return response()->json(null, 204);
    }
    
    public function confirmPayment(string $id)
    {
        $this->service->confirmPayment($id);

        return response()->json(null, 204);
    }

    public function create(PostPayment $request)
    {
        $resource = $this->service->create($request->all());

        return response()->json($resource, 201);
    }
}
