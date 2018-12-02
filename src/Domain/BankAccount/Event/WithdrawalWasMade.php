<?php

namespace ElyAccount\BankAccount\Event;

use ElyAccount\BankAccount\AccountNumber;
use ElyAccount\BankAccount\Withdrawal;
use ddd\Event\BasicDomainEvent;
use ddd\Event\DomainEvent;

/**
 * Emited to make a withdraw.
 *
 * @see DomainEvent
 */
class WithdrawalWasMade implements DomainEvent
{
    use BasicDomainEvent;

    /**
     * @var Withdrawal
     */
    private $withdrawal;

    /**
     * Creates a new event.
     *
     * @param AccountNumber $number
     * @param Withdrawal $withdrawal
     *
     * @return self
     */
    public static function fromAmount(AccountNumber $number, Withdrawal $withdrawal): self
    {
        return new self($number, $withdrawal);
    }

    /**
     * Gets the withdrawal.
     *
     * @return Withdrawal
     */
    public function withdrawal(): Withdrawal
    {
        return $this->withdrawal;
    }

    /**
     * Initialize an event.
     *
     * @param AccountNumber $number
     * @param Withdrawal $withdrawal
     */
    private function __construct(AccountNumber $number, Withdrawal $withdrawal)
    {
        $this->initializeTheEvent($number);
        $this->withdrawal = $withdrawal;
    }
}
