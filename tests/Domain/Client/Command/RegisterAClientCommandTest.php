<?php

namespace ElyAccount\Tests\Client\Command;

use ElyAccount\Client\Command\RegisterAClientCommand;
use ElyAccount\Client\ClientName;
use ElyAccount\Client\ClientId;
use PHPUnit\Framework\TestCase;

class RegisterAClientCommandTest extends TestCase
{
    /**
     * @var SignUpAClientCommand
     */
    private $sut;

    /**
     * @var ClientId
     */
    private $id;

    /**
     * @var PersonName
     */
    private $clientName;

    protected function setUp()
    {
        $this->id = ClientId::generate();
        $this->clientName = ClientName::fromStrings('Dupontel', 'Albert');
        $this->sut = RegisterAClientCommand::prepare($this->id, $this->clientName);
    }

    /**
     * @test
     */
    public function shouldExposeAClientId()
    {
        $this->assertSame($this->id, $this->sut->clientId());
    }

    /**
     * @test
     */
    public function shoudlExposeAClientName()
    {
        $this->assertSame($this->clientName, $this->sut->clientName());
    }
}
