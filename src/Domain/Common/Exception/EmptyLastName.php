<?php

namespace ElyAccount\Common\Exception;

use ElyAccount\Exception\DomainException;
use ElyAccount\Common\Exception\EmptyLastName;

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
