<?php

namespace ElyAccount\Domain\Common\Exception;

/**
 * Thrown when trying to create an empty first name.
 *
 * @final
 */
final class EmptyFirstNameException extends FirstNameException
{
    /**
     * Throw an exception because an attempt was made to create an empty first name.
     *
     * @return EmptyFirstNameException
     */
    public static function becauseAFirstNameCantBeEmpty(): EmptyFirstNameException
    {
        return new self();
    }

    /**
     * Initializes the exception.
     *
     * @return void
     */
    private function __construct()
    {
        parent::__construct('A first name can\'t be empty.');
    }
}
