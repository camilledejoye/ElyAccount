<?php

namespace ElyAccount\Tests\Domain\Client\Handler;

use ElyAccount\Domain\Client\Command\RegisterAClientCommand;
use ElyAccount\Domain\Client\Handler\RegisterAClientHandler;
use ElyAccount\Domain\Client\ClientName;
use ElyAccount\Domain\Client\ClientId;
use ElyAccount\Domain\Client\Client;
use ElyAccount\Domain\Client\ClientRepository;
use PHPUnit\Framework\TestCase;

class RegisterAClientHandlerTest extends TestCase
{
    /**
     * @test
     */
    public function shouldSignUpANewClient()
    {
        $clientRepository = $this->getMockForAbstractClass(ClientRepository::class);
        $sut              = new RegisterAClientHandler($clientRepository);

        $clientId = ClientId::generate();
        $name     = ClientName::fromStrings('Remi', 'Léon');
        $command  = RegisterAClientCommand::prepare($clientId, $name);

        $clientRepository->expects($this->once())
            ->method('save')
            ->with($this->equalTo(Client::signUp($clientId, $name)));

        $sut->handle($command);
    }
}
