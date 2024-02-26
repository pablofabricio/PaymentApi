<?php

namespace Tests\Unit\Repository;

use App\Models\Payer;
use App\Repositories\PayerRepository;
use Illuminate\Container\Container;
use PHPUnit\Framework\TestCase;

class PayerRepositoryTest extends TestCase
{
    public function testExistsModel()
    {
        $this->assertTrue(class_exists('App\Repositories\PayerRepository'));
    }

    public function testModel()
    {
        $repository = new PayerRepository(new Container);

        $this->assertEquals(Payer::class, $repository->model());
    }
}
