<?php

namespace ElyAccount\Command;

/**
 * Handles a command.
 */
interface HandlesCommand
{
    /**
     * Handle the given command.
     *
     * @param Command $command
     *
     * @return void
     */
    public function handle(Command $command);

    /**
     * Gets the type of the command handled by this handler.
     *
     * @return string
     */
    public static function getCommandHandledType(): string;
}
