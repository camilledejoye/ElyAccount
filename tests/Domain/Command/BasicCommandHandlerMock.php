<?php

namespace ElyAccount\Tests\Domain\Command;

use ElyAccount\Domain\Command\BasicCommandHandler;
use ElyAccount\Domain\Command\Command;
use ElyAccount\Domain\Command\HandlesCommand;

/**
 * Creates a mock manually because PHPUnit can't handle the static call
 * to getCommandHandledType() inside another static method.
 *
 * @see HandlesCommand
 */
class BasicCommandHandlerMock implements HandlesCommand
{
    use BasicCommandHandler;

    private $commandForwarded;

    public function __construct()
    {
        $this->commandForwarded = null;
    }

    public function commandForwarded()
    {
        return $this->commandForwarded;
    }

    protected function doHandle(Command $command)
    {
        $this->commandForwarded = $command;
    }

    protected static function getCommandHandledType(): string
    {
        return DummyCommand::class;
    }
}
