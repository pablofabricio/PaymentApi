<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Services\Payment\PaymentService;
use Illuminate\Http\Request;

class PaymentController
{
    public function __construct(
        private PaymentService $service
    ) {}

    public function all()
    {
        return PaymentResource::collection($this->service->all());
    }

    public function find(string $id)
    {
        return new PaymentResource($this->service->find($id));
    }
    
    public function destroy(string $id)
    {
        $this->service->destroy($id);

        return response()->json(null, 204);
    }
    
    public function confirmPayment(string $id, Request $request)
    {
        $this->service->confirmPayment($request->all(), $id);

        return response()->json(null, 204);
    }

    public function create(Request $request)
    {
        $resource = $this->service->create($request->all());

        return response()->json($resource, 201);
    }
}
