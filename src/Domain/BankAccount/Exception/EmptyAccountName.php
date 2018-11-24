<?php

namespace ElyAccount\Domain\BankAccount\Exception;

use ElyAccount\Domain\Exception\DomainException;
use ElyAccount\Domain\BankAccount\Exception\EmptyAccountName;

class EmptyAccountName extends DomainException
{
    public static function becauseAnACcountNameCantBeEmpty(): EmptyAccountName
    {
        return new self(
            'An account name can not be empty.'
        );
    }
}
