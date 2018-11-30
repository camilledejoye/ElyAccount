<?php

namespace ElyAccount\Domain\BankAccount\Command;

use ElyAccount\Domain\BankAccount\AccountNumber;
use ElyAccount\Domain\Command\Command;
use Money\Money;

/**
 * Makes a deposit.
 *
 * @see Command
 * @final
 */
final class MakeADepositCommand implements Command
{
    /**
     * @var AccountNumber
     */
    private $accountNumber;

    /**
     * @var Money
     */
    private $amount;

    /**
     * Prepares a command to make a deposit.
     *
     * @param AccountNumber $accountNumber
     * @param Money $amount
     *
     * @return self
     */
    public static function prepare(AccountNumber $accountNumber, Money $amount): self
    {
        return new self($accountNumber, $amount);
    }

    /**
     * Gets the number of the account to deposit on.
     *
     * @return AccountNumber
     */
    public function accountNumber(): AccountNumber
    {
        return $this->accountNumber;
    }

    /**
     * Get the amount of the deposit.
     *
     * @return Money
     */
    public function amount(): Money
    {
        return $this->amount;
    }

    /**
     * Initializes a command.
     *
     * @param AccountNumber $accountNumber
     * @param Money $amount
     */
    private function __construct(AccountNumber $accountNumber, Money $amount)
    {
        $this->accountNumber = $accountNumber;
        $this->amount        = $amount;
    }
}
