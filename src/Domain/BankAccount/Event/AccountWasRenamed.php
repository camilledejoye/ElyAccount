<?php

namespace ElyAccount\BankAccount\Event;

use ElyAccount\BankAccount\AccountName;
use ElyAccount\BankAccount\AccountNumber;
use ddd\Event\BasicDomainEvent;
use ddd\Event\DomainEvent;

class AccountWasRenamed implements DomainEvent
{
    use BasicDomainEvent;

    /**
     * @var AccountName
     */
    private $name;

    /**
     * Renames an account.
     *
     * @param AccountName $name
     *
     * @return self
     */
    public static function fromName(AccountNumber $number, AccountName $name): self
    {
        return new self($number, $name);
    }

    /**
     * Gets the new name of an account.
     *
     * @return AccountName
     */
    public function name(): AccountName
    {
        return $this->name;
    }

    /**
     * Initializes the event.
     *
     * @param AccountNumber $number
     * @param AccountName $name
     *
     * @return void
     */
    public function __construct(AccountNumber $number, AccountName $name)
    {
        $this->initializeTheEvent($number);
        $this->name = $name;
    }
}
