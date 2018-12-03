<?php

namespace ElyAccount\Command;

use ElyAccount\Command\Exception\ReceivedInvalidCommandType;

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
     * {@inheritdoc}
     */
    abstract public static function getCommandHandledType(): string;

    /**
     * Asserts that a command is of the same type as the handled command.
     *
     * @param Command $command
     *
     * @return void
     *
     * @throws ReceivedInvalidCommandType
     */
    protected static function assertThatACommandIsOfTheHandledType(Command $command)
    {
        $expectedType = static::getCommandHandledType();

        if (!($command instanceof $expectedType)) {
            throw ReceivedInvalidCommandType::becauseItsTheWrongCommandType(
                $expectedType,
                get_class($command)
            );
        }
    }
}
