<?php

namespace Tests\Unit\Repository;

use App\Models\Payment;
use App\Repositories\PaymentRepository;
use Illuminate\Container\Container;
use PHPUnit\Framework\TestCase;

class PaymentRepositoryTest extends TestCase
{
    public function testExistsModel()
    {
        $this->assertTrue(class_exists('App\Repositories\PaymentRepository'));
    }

    public function testModel()
    {
        $repository = new PaymentRepository(new Container);

        $this->assertEquals(Payment::class, $repository->model());
    }
}
