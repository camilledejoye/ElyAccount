<?php

namespace ElyAccount\Domain\BankAccount\Repository;

use ElyAccount\Domain\BankAccount\AccountNumber;
use ElyAccount\Domain\BankAccount\BankAccount;

interface BankAccountRepository
{
    /**
     * Gets a bank account from it's number.
     *
     * @param AccountNumber $accountNumber
     *
     * @return BankAccount
     */
    public function get(AccountNumber $accountNumber): BankAccount;

    /**
     * Saves a bank account.
     *
     * @param BankAccount $account
     *
     * @return static
     */
    public function save(BankAccount $account): self;
}
