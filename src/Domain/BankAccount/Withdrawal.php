<?php

namespace ElyAccount\BankAccount;

use Money\Money;

/**
 * A withdrawal.
 *
 * @see Operation
 */
class Withdrawal implements Operation
{
    use BasicOperation;

    /**
     * Creates a withdrawal from an amount.
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
     * Initialize a withdrawal.
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
