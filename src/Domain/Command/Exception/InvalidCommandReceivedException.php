<?php

namespace ElyAccount\Domain\Command\Exception;

/**
 * Exception thrown when a command handler receive a command of another
 * type that the one is supposed to handle.
 *
 * @see \RuntimeException
 */
class InvalidCommandReceivedException extends \RuntimeException
{
    public function __construct(string $expectedType, string $commandType)
    {
        parent::__construct(sprintf(
            'Expect to receive a "%s" but actually got "%s"',
            $expectedType,
            $commandType
        ));
    }
}
