<?php

namespace ElyAccount\Domain\BankAccount;

use Money\Money;

/**
 * A deposit.
 *
 * @see Operation
 */
class Deposit implements Operation
{
    use BasicOperation;

    /**
     * Creates a deposit from an amount.
     *
     * @param Money $amount
     *
     * @return self
     *
     * @throws InvalidAmountOperation
     */
    public static function fromAmount(Money $amount): self
    {
        return new self($amount);
    }

    /**
     * Initialize a deposit.
     *
     * @param Money $amount
     *
     * @throws InvalidAmountOperation
     */
    private function __construct(Money $amount)
    {
        $this->initializeTheOperation($amount);
    }
}
