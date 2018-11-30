<?php

namespace ElyAccount\Domain\Client\Handler;

use ElyAccount\Domain\Client\Command\RegisterAClientCommand;
use ElyAccount\Domain\Command\BasicCommandHandler;
use ElyAccount\Domain\Command\Command;
use ElyAccount\Domain\Client\Client;
use ElyAccount\Domain\Command\HandlesCommand;
use ElyAccount\Domain\Client\ClientRepository;

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
    protected static function getCommandHandledType(): string
    {
        return RegisterAClientCommand::class;
    }
}
