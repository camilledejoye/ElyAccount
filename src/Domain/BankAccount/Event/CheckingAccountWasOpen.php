<?php

namespace ElyAccount\BankAccount\Event;

use ElyAccount\BankAccount\AccountNumber;
use ElyAccount\Client\ClientId;
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
     * @var ClientId
     */
    private $ownerId;

    /**
     * Opens a checking account with a given currency.
     *
     * @param AccountNumber $number
     * @param Currency $currency
     *
     * @return self
     */
    public static function forAClient(ClientId $ownerId, AccountNumber $number, Currency $currency): self
    {
        return new self($ownerId, $number, $currency);
    }

    /**
     * Gets the currency of the account.
     *
     * @return Currency
     */
    public function currency(): Currency
    {
        return $this->currency;
    }

    /**
     * Gets the identity of the owner of the account.
     *
     * @return ClientId
     */
    public function ownerId(): ClientId
    {
        return $this->ownerId;
    }

    /**
     * Initializes the event.
     *
     * @param AccountNumber $number
     * @param Currency $currency
     */
    protected function __construct(ClientId $ownerId, AccountNumber $number, Currency $currency)
    {
        $this->initializeTheEvent($number);
        $this->currency = $currency;
        $this->ownerId = $ownerId;
    }
}
