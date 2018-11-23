<?php

namespace ElyAccount\Domain\BankAccount\Event;

use ElyAccount\Domain\BankAccount\AccountNumber;
use Money\Currency;
use ddd\Event\BasicDomainEvent;
use ddd\Event\DomainEvent;

class CheckingAccountWasOpen implements DomainEvent
{
    use BasicDomainEvent;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * Opens a checking account with a given currency.
     *
     * @param AccountNumber $number
     * @param Currency $currency
     *
     * @return self
     */
    public static function withCurrency(AccountNumber $number, Currency $currency): self
    {
        return new self($number, $currency);
    }

    public function currency(): Currency
    {
        return $this->currency;
    }

    /**
     * Initializes the event.
     *
     * @param AccountNumber $number
     * @param Currency $currency
     */
    protected function __construct(AccountNumber $number, Currency $currency)
    {
        $this->initializeTheEvent($number);
        $this->currency = $currency;
    }
}
