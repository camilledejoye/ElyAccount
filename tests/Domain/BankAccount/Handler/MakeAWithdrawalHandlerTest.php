<?php

namespace ElyAccount\Tests\Domain\BankAccount\Handler;

use ElyAccount\Domain\BankAccount\AccountNumber;
use ElyAccount\Domain\BankAccount\BankAccount;
use ElyAccount\Domain\BankAccount\Command\MakeAWithdrawalCommand;
use ElyAccount\Domain\BankAccount\Handler\MakeAWithdrawalHandler;
use ElyAccount\Domain\BankAccount\Repository\BankAccountRepository;
use Money\Money;
use PHPUnit\Framework\TestCase;

class MakeAWithdrawalHandlerTest extends TestCase
{
    /**
     * @test
     */
    public function shouldMakeAWithdrawal()
    {
        $bankAccountRepository = $this->createMock(BankAccountRepository::class);
        $bankAccount           = $this->createMock(BankAccount::class);
        $sut                   = new MakeAWithdrawalHandler($bankAccountRepository);

        $accountNumber = AccountNumber::generate();
        $amount        = Money::EUR(4530959043);

        $bankAccountRepository
            ->method('get')
            ->with($this->identicalTo($accountNumber))
            ->willReturn($bankAccount);
        $bankAccount->expects($this->once())
            ->method('withdraw')
            ->with($this->identicalTo($amount));

        $sut->handle(
            MakeAWithdrawalCommand::prepare($accountNumber, $amount)
        );
    }
}
