<?php

namespace ElyAccount\BankAccount\Event;

use ElyAccount\BankAccount\AccountNumber;
use ElyAccount\BankAccount\Deposit;
use ddd\Event\BasicDomainEvent;
use ddd\Event\DomainEvent;

/**
 * Emited to make a withdraw.
 *
 * @see DomainEvent
 */
class DepositWasMade implements DomainEvent
{
    use BasicDomainEvent;

    /**
     * @var Deposit
     */
    private $deposit;

    /**
     * Creates a new event.
     *
     * @param AccountNumber $number
     * @param Deposit $deposit
     *
     * @return self
     */
    public static function fromAmount(AccountNumber $number, Deposit $deposit): self
    {
        return new self($number, $deposit);
    }

    /**
     * Gets the deposit.
     *
     * @return Deposit
     */
    public function deposit(): Deposit
    {
        return $this->deposit;
    }

    /**
     * Initialize an event.
     *
     * @param AccountNumber $number
     * @param Deposit $deposit
     */
    private function __construct(AccountNumber $number, Deposit $deposit)
    {
        $this->initializeTheEvent($number);
        $this->deposit = $deposit;
    }
}
