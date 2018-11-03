<?php

namespace ElyAccount\Domain\Command;

use ElyAccount\Domain\Command\Exception\CommandHandlerException;
use ElyAccount\Domain\Command\Exception\InvalidCommandReceivedException;

/**
 * Trait used to provide a basic implementation for CommandHanlder.
 * Mainly to compensate the lack of convariant parameters in PHP...
 */
trait BasicCommandHandler
{
    /**
     * {@inheritdoc}
     */
    public function handle(Command $command)
    {
        static::assertThatACommandIsOfTheHandledType($command);

        $this->doHandle($command);
    }

    /**
     * Actually handles the command.
     *
     * @param Command $command
     *
     * @return void
     */
    abstract protected function doHandle(Command $command);

    /**
     * Gets the type of the command handled by this handler.
     *
     * @return string
     */
    abstract protected static function getCommandHandledType(): string;

    /**
     * Asserts that a command is of the same type as the handled command.
     *
     * @param Command $command
     *
     * @return void
     *
     * @throws InvalidCommandReceivedException
     */
    protected static function assertThatACommandIsOfTheHandledType(Command $command)
    {
        $expectedType = static::getCommandHandledType();

        if (!($command instanceof $expectedType)) {
            throw CommandHandlerException::becauseItReceivedAnInvalidCommandType(
                $expectedType,
                get_class($command)
            );
        }
    }
}
