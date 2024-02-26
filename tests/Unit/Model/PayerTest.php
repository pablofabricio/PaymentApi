<?php

namespace Tests\Unit\Model;

use PHPUnit\Framework\TestCase;

class PayerTest extends TestCase
{
    public function testExistsModel()
    {
        $this->assertTrue(class_exists('App\Models\Payer'));
    }
}
