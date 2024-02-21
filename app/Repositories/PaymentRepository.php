<?php

namespace App\Repositories;

use App\Models\Payment;
use Prettus\Repository\Eloquent\BaseRepository;

class PaymentRepository extends BaseRepository
{
    public function model()
    {
        return Payment::class;
    }
}
