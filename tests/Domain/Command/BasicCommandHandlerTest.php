<?php

namespace ElyAccount\Tests\Domain\Command;

use ElyAccount\Domain\Command\BasicCommandHandler;
use ElyAccount\Domain\Command\Command;
use ElyAccount\Domain\Command\Exception\InvalidCommandReceivedException;
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
        $this->expectException(InvalidCommandReceivedException::class);

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
