<?php

namespace ElyAccount\Tests\Domain\BankAccount;

use ElyAccount\Domain\BankAccount\Withdrawal;
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
