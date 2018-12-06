<?php

namespace App\Repository;

use ElyAccount\BankAccount\AccountNumber;
use ElyAccount\BankAccount\BankAccount;
use ElyAccount\BankAccount\BankAccountRepository;

class BankAccountTestRepository implements BankAccountRepository
{
    /**
     * {@inheritDoc}
     */
    public function get(AccountNumber $accountNumber): BankAccount
    {
    }

    /**
     * {@inheritDoc}
     */
    public function save(BankAccount $account): BankAccountRepository
    {
    }
}
