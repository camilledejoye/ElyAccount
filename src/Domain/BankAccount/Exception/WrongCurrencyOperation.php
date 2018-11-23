<?php

namespace ElyAccount\Domain\BankAccount\Exception;

use ElyAccount\Domain\Exception\RuntimeException;
use Money\Currency;

/**
 * Thrown when attempted to make an operation with the wrong currency.
 *
 * @see RuntimeException
 */
class WrongCurrencyOperation extends RuntimeException
{
    public static function becauseTheCurrencyDiffersFromTheAccount(
        Currency $expected,
        Currency $received
    ): self {
        return new self(sprintf(
            'An operation must be made in the same currency than the account it operates on.'
            . ' "%s" was expected, "%s" received.',
            $expected,
            $received
        ));
    }
}
