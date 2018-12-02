<?php

namespace ElyAccount\BankAccount\Handler;

use ElyAccount\BankAccount\Command\MakeAWithdrawalCommand;
use ElyAccount\BankAccount\Repository\BankAccountRepository;
use ElyAccount\Command\BasicCommandHandler;
use ElyAccount\Command\Command;
use ElyAccount\Command\HandlesCommand;

class MakeAWithdrawalHandler implements HandlesCommand
{
    use BasicCommandHandler;

    /**
     * @var BankAccountRepository
     */
    private $bankAccountRepository;

    /**
     * Creates a handler for MakeAWithdrawalCommand commands.
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
     * @param MakeAWithdrawalCommand $command
     */
    protected function doHandle(Command $command)
    {
        $account = $this->bankAccountRepository
            ->get($command->accountNumber());

        $account->withdraw($command->amount());
    }

    /**
     * {@inheritdoc}
     */
    protected static function getCommandHandledType(): string
    {
        return MakeAWithdrawalCommand::class;
    }
}
