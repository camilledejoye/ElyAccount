<?php

namespace ElyAccount\Tests\Domain\BankAccount\Event;

use ElyAccount\Domain\BankAccount\AccountNumber;
use ElyAccount\Domain\BankAccount\Event\DepositWasMade;
use ElyAccount\Domain\BankAccount\Deposit;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class DepositWasMadeTest extends TestCase
{
    /**
     * @test
     */
    public function shouldInitializeTheEvent()
    {
        $accountNumber = $this->createAnAccountNumber();
        $deposit = $this->createADeposit();
        $sut = $this->createPartialMock(DepositWasMade::class, ['initializeTheEvent']);
        $sut->expects($this->once())
            ->method('initializeTheEvent');

        $reflection = new ReflectionClass($sut);
        $constructor = $reflection->getConstructor();
        $constructor->setAccessible(true);
        $constructor->invokeArgs($sut, [$accountNumber, $deposit]);
    }

    /**
     * @test
     */
    public function shouldProvideADeposit()
    {
        $accountNumber = $this->createAnAccountNumber();
        $deposit = $this->createADeposit();
        $sut = DepositWasMade::fromAmount($accountNumber, $deposit);

        $this->assertSame($deposit, $sut->deposit());
    }

    private function createAnAccountNumber(): AccountNumber
    {
        return AccountNumber::generate();
    }

    private function createADeposit(): Deposit
    {
        return $this->createMock(Deposit::class);
    }
}
