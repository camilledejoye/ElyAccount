<?php

namespace ElyAccount\Domain\Common\Exception;

use ElyAccount\Domain\Exception\DomainException;
use ElyAccount\Domain\Common\Exception\EmptyLastName;

/**
 * Thrown when trying to create an empty last name.
 *
 * @final
 */
final class EmptyLastName extends DomainException
{
    /**
     * Throw an exception because an attempt was made to create an empty last name.
     *
     * @return EmptyLastName
     */
    public static function becauseALastNameCantBeEmpty(): EmptyLastName
    {
        return new self('A last name can\'t be empty.');
    }
}
