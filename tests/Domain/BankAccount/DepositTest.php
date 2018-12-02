<?php

namespace ElyAccount\Tests\BankAccount;

use ElyAccount\BankAccount\Deposit;
use Money\Money;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class DepositTest extends TestCase
{
    /**
     * @test
     */
    public function shouldInitializeTheOperation()
    {
        $amount = Money::EUR(65743);
        $sut = $this->createPartialMock(Deposit::class, ['initializeTheOperation']);

        $sut->expects($this->once())
            ->method('initializeTheOperation')
            ->with($this->identicalTo($amount));

        $reflection = new ReflectionClass($sut);
        $constructor = $reflection->getConstructor();
        $constructor->setAccessible(true);
        $constructor->invoke($sut, $amount);
    }
}
