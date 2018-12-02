<?php

namespace ElyAccount\BankAccount\Handler;

use ElyAccount\BankAccount\Command\MakeADepositCommand;
use ElyAccount\BankAccount\Repository\BankAccountRepository;
use ElyAccount\Command\BasicCommandHandler;
use ElyAccount\Command\Command;
use ElyAccount\Command\HandlesCommand;

class MakeADepositHandler implements HandlesCommand
{
    use BasicCommandHandler;

    /**
     * @var BankAccountRepository
     */
    private $bankAccountRepository;

    /**
     * Creates a handler for MakeADepositCommand commands.
     *
     * @param BankAccountRepository $bankAccountRepository
     */
    public function __construct(BankAccountRepository $bankAccountRepository)
    {
        $this->bankAccountRepository = $bankAccountRepository;
    }

    /**
     * {@inheritdoc}
     *
     * @param MakeADepositCommand $command
     */
    protected function doHandle(Command $command)
    {
        $account = $this->bankAccountRepository
            ->get($command->accountNumber());

        $account->deposit($command->amount());
    }

    /**
     * {@inheritdoc}
     */
    protected static function getCommandHandledType(): string
    {
        return MakeADepositCommand::class;
    }
}
