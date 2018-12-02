<?php

namespace ElyAccount\BankAccount\Command;

use ElyAccount\BankAccount\AccountNumber;
use ElyAccount\Client\ClientId;
use ElyAccount\Command\Command;
use Money\Currency;

final class OpenACheckingAccountForAClientCommand implements Command
{
    /**
     * @var ClientId
     */
    private $ownerId;

    /**
     * @var AccountNumber
     */
    private $number;

    /**
     * @var Currency
     */
    private $currency;


    /**
     * Prepares a new command.
     *
     * @param ClientId $ownerId
     * @param AccountNumber $number
     * @param Currency $currency
     *
     * @return self
     */
    public static function prepare(ClientId $ownerId, AccountNumber $number, Currency $currency): self
    {
        return new self($ownerId, $number, $currency);
    }

    /**
     * Initializes the command.
     *
     * @param ClientId $ownerId
     * @param AccountNumber $number
     * @param Currency $currency
     */
    private function __construct(ClientId $ownerId, AccountNumber $number, Currency $currency)
    {
        $this->ownerId  = $ownerId;
        $this->number   = $number;
        $this->currency = $currency;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }

    public function number(): AccountNumber
    {
        return $this->number;
    }

    public function ownerId(): ClientId
    {
        return $this->ownerId;
    }
}
