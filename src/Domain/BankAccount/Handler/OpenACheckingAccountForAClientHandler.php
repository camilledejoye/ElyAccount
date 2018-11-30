<?php

namespace ElyAccount\Domain\BankAccount\Handler;

use ElyAccount\Domain\BankAccount\CheckingAccount;
use ElyAccount\Domain\BankAccount\Command\OpenACheckingAccountForAClientCommand;
use ElyAccount\Domain\BankAccount\Repository\BankAccountRepository;
use ElyAccount\Domain\Command\BasicCommandHandler;
use ElyAccount\Domain\Command\Command;
use ElyAccount\Domain\Command\HandlesCommand;

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
    protected static function getCommandHandledType(): string
    {
        return OpenACheckingAccountForAClientCommand::class;
    }
}
