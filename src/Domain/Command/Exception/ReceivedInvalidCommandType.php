<?php

namespace ElyAccount\Command\Exception;

use ElyAccount\Exception\RuntimeException;

/**
 * Exception thrown when a command handler receive a command of another
 * type that the one is supposed to handle.
 *
 * @see RuntimeException
 */
class ReceivedInvalidCommandType extends RuntimeException
{
    public static function becauseItsTheWrongCommandType(
        string $expectedType,
        string $commandType
    ): self {
        return new self(sprintf(
            'Expect to receive a "%s" but actually got "%s"',
            $expectedType,
            $commandType
        ));
    }
}
