<?php

namespace ElyAccount\Tests\Command;

use ElyAccount\Command\BasicCommandHandler;
use ElyAccount\Command\Command;
use ElyAccount\Command\Exception\ReceivedInvalidCommandType;
use PHPUnit\Framework\TestCase;

class BasicCommandHandlerTest extends TestCase
{
    /**
     * @var BasicCommandHandlerMock
     */
    private $sut;

    protected function setUp()
    {
        $this->sut = new BasicCommandHandlerMock();
    }

    /**
     * @test
     */
    public function shouldRejectUnhandledCommands()
    {
        $this->expectException(ReceivedInvalidCommandType::class);

        $command = $this->getMockForAbstractClass(Command::class);
        $this->sut->handle($command);
    }

    /**
     * @test
     */
    public function shouldForwardHandledCommands()
    {
        $command = new DummyCommand();
        $this->sut->handle($command);

        $this->assertSame($command, $this->sut->commandForwarded());
    }
}
