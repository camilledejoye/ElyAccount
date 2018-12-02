<?php

namespace ElyAccount\Tests\Client\Handler;

use ElyAccount\Client\Command\RegisterAClientCommand;
use ElyAccount\Client\Handler\RegisterAClientHandler;
use ElyAccount\Client\ClientName;
use ElyAccount\Client\ClientId;
use ElyAccount\Client\Client;
use ElyAccount\Client\ClientRepository;
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
