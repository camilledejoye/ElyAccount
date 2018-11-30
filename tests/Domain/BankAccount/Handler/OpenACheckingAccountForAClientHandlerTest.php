<?php

namespace ElyAccount\Tests\Domain\BankAccount\Handler;

use ElyAccount\Domain\BankAccount\AccountNumber;
use ElyAccount\Domain\BankAccount\CheckingAccount;
use ElyAccount\Domain\BankAccount\Command\OpenACheckingAccountForAClientCommand;
use ElyAccount\Domain\BankAccount\Handler\OpenACheckingAccountForAClientHandler;
use ElyAccount\Domain\BankAccount\Repository\BankAccountRepository;
use ElyAccount\Domain\Client\ClientId;
use Money\Currency;
use PHPUnit\Framework\TestCase;

class OpenACheckingAccountForAClientHandlerTest extends TestCase
{
    const CURRENCY_CODE = 'EUR';

    /**
     * @test
     */
    public function shouldOpenACheckingAccount()
    {
        $bankAccountRepository = $this->createMock(BankAccountRepository::class);
        $sut = new OpenACheckingAccountForAClientHandler($bankAccountRepository);

        $ownerId = ClientId::generate();
        $number = AccountNumber::generate();
        $currency = new Currency(self::CURRENCY_CODE);
        $command = OpenACheckingAccountForAClientCommand::prepare($ownerId, $number, $currency);

        $checkingAccount = CheckingAccount::open($number, $currency, $ownerId);

        $bankAccountRepository->expects($this->once())
            ->method('save')
            ->with($this->equalTo($checkingAccount));

        $sut->handle($command);
    }
}
