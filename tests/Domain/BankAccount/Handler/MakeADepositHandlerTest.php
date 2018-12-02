<?php

namespace ElyAccount\Tests\BankAccount\Handler;

use ElyAccount\BankAccount\AccountNumber;
use ElyAccount\BankAccount\BankAccount;
use ElyAccount\BankAccount\Command\MakeADepositCommand;
use ElyAccount\BankAccount\Handler\MakeADepositHandler;
use ElyAccount\BankAccount\Repository\BankAccountRepository;
use Money\Money;
use PHPUnit\Framework\TestCase;

class MakeADepositHandlerTest extends TestCase
{
    /**
     * @test
     */
    public function shouldMakeADeposit()
    {
        $bankAccountRepository = $this->createMock(BankAccountRepository::class);
        $bankAccount           = $this->createMock(BankAccount::class);
        $sut                   = new MakeADepositHandler($bankAccountRepository);

        $accountNumber = AccountNumber::generate();
        $amount        = Money::EUR(4530959043);

        $bankAccountRepository
            ->method('get')
            ->with($this->identicalTo($accountNumber))
            ->willReturn($bankAccount);
        $bankAccount->expects($this->once())
            ->method('deposit')
            ->with($this->identicalTo($amount));

        $sut->handle(
            MakeADepositCommand::prepare($accountNumber, $amount)
        );
    }
}
