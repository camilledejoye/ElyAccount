<?php

namespace ElyAccount\Domain\Common\Exception;

/**
 * Thrown when trying to create an empty last name.
 *
 * @final
 */
final class EmptyLastNameException extends LastNameException
{
    /**
     * Throw an exception because an attempt was made to create an empty last name.
     *
     * @return EmptyLastNameException
     */
    public static function becauseALastNameCantBeEmpty(): EmptyLastNameException
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
        parent::__construct('A last name can\'t be empty.');
    }
}
