<?php

namespace ElyAccount\Domain\BankAccount\Exception;

use ElyAccount\Domain\Exception\InvalidArgumentException;

class AccountNameException extends InvalidArgumentException
{
    public static function becauseAnACcountNameCantBeEmpty(): AccountNameException
    {
        return new self(
            'An account name can not be empty.'
        );
    }
}
