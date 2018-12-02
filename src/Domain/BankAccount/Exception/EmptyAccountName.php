<?php

namespace ElyAccount\BankAccount\Exception;

use ElyAccount\Exception\DomainException;
use ElyAccount\BankAccount\Exception\EmptyAccountName;

class EmptyAccountName extends DomainException
{
    public static function becauseAnACcountNameCantBeEmpty(): EmptyAccountName
    {
        return new self(
            'An account name can not be empty.'
        );
    }
}
