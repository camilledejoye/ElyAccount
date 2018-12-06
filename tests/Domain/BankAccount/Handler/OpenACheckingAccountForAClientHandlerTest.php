<?php

namespace ElyAccount\Tests\BankAccount\Handler;

use ElyAccount\BankAccount\AccountNumber;
use ElyAccount\BankAccount\CheckingAccount;
use ElyAccount\BankAccount\Command\OpenACheckingAccountForAClientCommand;
use ElyAccount\BankAccount\Handler\OpenACheckingAccountForAClientHandler;
use ElyAccount\BankAccount\BankAccountRepository;
use ElyAccount\Client\ClientId;
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
