<?php

namespace ElyAccount\Tests\BankAccount\Event;

use ElyAccount\BankAccount\AccountNumber;
use ElyAccount\BankAccount\Event\WithdrawalWasMade;
use ElyAccount\BankAccount\Withdrawal;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class WithdrawalWasMadeTest extends TestCase
{
    /**
     * @test
     */
    public function shouldInitializeTheEvent()
    {
        $accountNumber = $this->createAnAccountNumber();
        $withdrawal = $this->createAWithdrawal();
        $sut = $this->createPartialMock(WithdrawalWasMade::class, ['initializeTheEvent']);
        $sut->expects($this->once())
            ->method('initializeTheEvent');

        $reflection = new ReflectionClass($sut);
        $constructor = $reflection->getConstructor();
        $constructor->setAccessible(true);
        $constructor->invokeArgs($sut, [$accountNumber, $withdrawal]);
    }

    /**
     * @test
     */
    public function shouldProvideAWithdrawal()
    {
        $accountNumber = $this->createAnAccountNumber();
        $withdrawal = $this->createAWithdrawal();
        $sut = WithdrawalWasMade::fromAmount($accountNumber, $withdrawal);

        $this->assertSame($withdrawal, $sut->withdrawal());
    }

    private function createAnAccountNumber(): AccountNumber
    {
        return AccountNumber::generate();
    }

    private function createAWithdrawal(): Withdrawal
    {
        return $this->createMock(Withdrawal::class);
    }
}
