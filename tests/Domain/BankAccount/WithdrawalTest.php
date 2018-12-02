<?php

namespace ElyAccount\Tests\BankAccount;

use ElyAccount\BankAccount\Withdrawal;
use Money\Money;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class WithdrawalTest extends TestCase
{
    /**
     * @test
     */
    public function shouldInitializeTheOperation()
    {
        $amount = Money::EUR(65743);
        $sut = $this->createPartialMock(Withdrawal::class, ['initializeTheOperation']);

        $sut->expects($this->once())
            ->method('initializeTheOperation')
            ->with($this->identicalTo($amount));

        $reflection = new ReflectionClass($sut);
        $constructor = $reflection->getConstructor();
        $constructor->setAccessible(true);
        $constructor->invoke($sut, $amount);
    }
}
