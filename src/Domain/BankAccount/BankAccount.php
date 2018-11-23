<?php

namespace ElyAccount\Domain\BankAccount;

use Money\Money;

interface BankAccount
{
    /**
     * Makes a deposit.
     *
     * @param Money $amount
     *
     * @return BankAccount
     *
     * @throws WrongCurrencyOperation
     * @throws InvalidAmountOperation
     */
    public function deposit(Money $amount): BankAccount;

    /**
     * Makes a withdrawal.
     *
     * @param Money $amount
     *
     * @return BankAccount
     *
     * @throws WrongCurrencyOperation
     * @throws InvalidAmountOperation
     */
    public function withdraw(Money $amount): BankAccount;

    /**
     * Rename an account
     *
     * @param AccountName $name
     *
     * @return BankAccount
     */
    public function rename(AccountName $name): BankAccount;

    /**
     * Gets the balance.
     *
     * @return Money
     */
    public function balance(): Money;

    /**
     * Gets the name.
     * If none has been provided, then it's the number of the account.
     *
     * @return AccountName
     */
    public function name(): AccountName;

    /**
     * Gets the number.
     *
     * @return AccountNumber
     */
    public function number(): AccountNumber;

    /**
     * Gets a string representig an account.
     *
     * @return string
     */
    public function toString(): string;

    /**
     * The string representation of an account.
     *
     * @return string
     */
    public function __toString(): string;
}
