<?php

namespace Tests\Unit;
use App\Services\MediaService;
use PHPUnit\Framework\TestCase;
class AccountTest extends TestCase
{
    public function test_account()
    {
        $account = MediaService::account(20);//40
        $this->assertEquals(40,$account);
        $this->assertLessThan(41,$account);
    }
}
