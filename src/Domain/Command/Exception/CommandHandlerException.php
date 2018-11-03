<?php

namespace ElyAccount\Domain\Command\Exception;

/**
 * Factory for CommandHandler exceptions.
 *
 * @abstract
 */
abstract class CommandHandlerException
{
    public static function becauseItReceivedAnInvalidCommandType(
        string $exceptedType,
        string $commandType
    ): InvalidCommandReceivedException {
        return new InvalidCommandReceivedException($exceptedType, $commandType);
    }
}
