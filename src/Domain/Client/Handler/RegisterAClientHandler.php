<?php

namespace ElyAccount\Client\Handler;

use ElyAccount\Client\Command\RegisterAClientCommand;
use ElyAccount\Command\BasicCommandHandler;
use ElyAccount\Command\Command;
use ElyAccount\Client\Client;
use ElyAccount\Command\HandlesCommand;
use ElyAccount\Client\ClientRepository;

/**
 * Registers a client.
 *
 * @see HandlesCommand
 * @final
 */
final class RegisterAClientHandler implements HandlesCommand
{
    use BasicCommandHandler;

    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * Initializes the handler.
     *
     * @param ClientRepository $clientRepository
     */
    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * {@inheritdoc}
     *
     * @param SignUpAClientCommand $command
     */
    protected function doHandle(RegisterAClientCommand $command)
    {
        $client = Client::signUp($command->clientId(), $command->clientName());
        $this->clientRepository->save($client);
    }

    /**
     * {@inheritdoc}
     */
    public static function getCommandHandledType(): string
    {
        return RegisterAClientCommand::class;
    }
}
