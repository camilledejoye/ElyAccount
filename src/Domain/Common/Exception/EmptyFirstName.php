<?php

namespace ElyAccount\Common\Exception;

use ElyAccount\Exception\DomainException;
use ElyAccount\Common\Exception\EmptyFirstName;

/**
 * Thrown when trying to create an empty first name.
 *
 * @final
 */
final class EmptyFirstName extends DomainException
{
    /**
     * Throw an exception because an attempt was made to create an empty first name.
     *
     * @return EmptyFirstName
     */
    public static function becauseAFirstNameCantBeEmpty(): EmptyFirstName
    {
        return new self('A first name can\'t be empty.');
    }
}
