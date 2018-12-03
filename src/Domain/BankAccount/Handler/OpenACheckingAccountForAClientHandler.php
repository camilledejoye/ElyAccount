<?php

namespace ElyAccount\BankAccount\Handler;

use ElyAccount\BankAccount\CheckingAccount;
use ElyAccount\BankAccount\Command\OpenACheckingAccountForAClientCommand;
use ElyAccount\BankAccount\Repository\BankAccountRepository;
use ElyAccount\Command\BasicCommandHandler;
use ElyAccount\Command\Command;
use ElyAccount\Command\HandlesCommand;

/**
 * Opens a new cheking account.
 *
 * @see HandlesCommand
 * @final
 */
final class OpenACheckingAccountForAClientHandler implements HandlesCommand
{
    use BasicCommandHandler;

    /**
     * @var BankAccountRepository
     */
    private $bankAccountRepository;

    public function __construct(BankAccountRepository $bankAccountRepository)
    {
        $this->bankAccountRepository = $bankAccountRepository;
    }

    /**
     * {@inheritdoc}
     */
    protected function doHandle(OpenACheckingAccountForAClientCommand $command)
    {
        $account = CheckingAccount::open(
            $command->number(),
            $command->currency(),
            $command->ownerId()
        );

        $this->bankAccountRepository->save($account);
    }

    /**
     * {@inheritdoc}
     */
    public static function getCommandHandledType(): string
    {
        return OpenACheckingAccountForAClientCommand::class;
    }
}
