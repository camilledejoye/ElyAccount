<?php

namespace ElyAccount\BankAccount;

use ddd\Identity\Uuid;

/**
 * Identifies a bank account.
 * For simplicity I use a UUID, even thow in reality there must be some rules defining it.
 *
 * @see Uuid
 */
class AccountNumber extends Uuid
{
}
