<?php

namespace ElyAccount\Domain\BankAccount\Exception;

use ElyAccount\Domain\Exception\DomainException;

/**
 * Thrown when trying to make an operation with an amount lower or equals to zero.
 *
 * @see DomainException
 */
class InvalidAmountOperation extends DomainException
{
    public static function becauseAnAmountMustBeGreaterThanZero(string $amount): self
    {
        return new self(sprintf(
            'The amount of any banking operation must be greater than zero, "%s" received.',
            $amount
        ));
    }
}
