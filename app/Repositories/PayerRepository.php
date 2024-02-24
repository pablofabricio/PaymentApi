<?php

namespace App\Repositories;

use App\Models\Payer;
use Prettus\Repository\Eloquent\BaseRepository;

class PayerRepository extends BaseRepository
{
    public function model()
    {
        return Payer::class;
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }
}
