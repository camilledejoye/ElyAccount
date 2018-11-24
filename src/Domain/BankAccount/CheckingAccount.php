<?php

namespace ElyAccount\Domain\BankAccount;

use ElyAccount\Domain\BankAccount\Event\AccountWasRenamed;
use ElyAccount\Domain\BankAccount\Event\CheckingAccountWasOpen;
use ElyAccount\Domain\BankAccount\Event\DepositWasMade;
use ElyAccount\Domain\BankAccount\Event\WithdrawalWasMade;
use ElyAccount\Domain\BankAccount\Exception\InvalidAmountOperation;
use ElyAccount\Domain\BankAccount\Exception\WrongCurrencyOperation;
use ElyAccount\Domain\Client\ClientId;
use Money\Currency;
use Money\Money;
use ddd\Aggregate\AggregateRoot;
use ddd\Aggregate\BasicAggregateRoot;
use ddd\Event\AggregateChanges;
use ddd\Event\AggregateHistory;

/**
 * A bank account that allows easy access to the funds.
 *
 * @see BankAccount
 */
class CheckingAccount implements BankAccount, AggregateRoot
{
    use BasicAggregateRoot;

    /**
     * @var AccountNumber
     */
    private $number;

    /**
     * @var ClientId
     */
    private $ownerId;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @var AccountName
     */
    private $name;

    /**
     * @var Money
     */
    private $balance;

    /**
     * @var CheckRegister
     */
    private $register;

    /**
     * Opens a checking account.
     *
     * @param AccountNumber $number
     * @param Currency $currency
     *
     * @return CheckingAccount
     */
    public static function open(AccountNumber $number, Currency $currency, ClientId $ownerId): CheckingAccount
    {
        $account = new self($number);

        $account->recordThat(CheckingAccountWasOpen::forAClient($ownerId, $number, $currency));

        return $account;
    }

    /**
     * {@inheritDoc}
     *
     * @return self
     */
    public static function reconstituteFrom(AggregateHistory $history)
    {
        return BasicAggregateRoot::doReconstituteFrom($history);
    }

    /**
     * {@inheritdoc}
     */
    public function deposit(Money $amount): BankAccount
    {
        $this->assertThatItsTheSameCurrencyThanTheAccount($amount->getCurrency());

        $deposit = Deposit::fromAmount($amount);
        $this->recordThat(DepositWasMade::fromAmount($this->number(), $deposit));

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withdraw(Money $amount): BankAccount
    {
        $this->assertThatItsTheSameCurrencyThanTheAccount($amount->getCurrency());

        $withdrawal = Withdrawal::fromAmount($amount);
        $this->recordThat(WithdrawalWasMade::fromAmount($this->number(), $withdrawal));

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function rename(AccountName $name): BankAccount
    {
        $this->recordThat(AccountWasRenamed::fromName($this->number(), $name));

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function balance(): Money
    {
        return $this->balance;
    }

    /**
     * {@inheritDoc}
     */
    public function name(): AccountName
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function number(): AccountNumber
    {
        return $this->number;
    }

    /**
     * {@inheritDoc}
     */
    public function isOwner(ClientId $clientId): bool
    {
        return $clientId->equals($this->ownerId);
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return $this->name() ?: $this->number();
    }

    /**
     * Initialize an account.
     *
     * @param AccountNumber $number
     */
    private function __construct(AccountNumber $number)
    {
        $this->number = $number;
        $this->pendingEvents = AggregateChanges::createFor($number);
    }

    /**
     * Checks if a currency is the same than the accounts one.
     *
     * @param Currency $currency
     *
     * @return bool
     */
    private function isTheSameCurrencyThanTheAccount(Currency $currency): bool
    {
        return $currency->equals($this->currency);
    }

    /**
     * Guards that all operations are made in the same currency than the account.
     *
     * @param Currency $currency
     *
     * @return void
     *
     * @throws WrongCurrencyOperation
     */
    private function assertThatItsTheSameCurrencyThanTheAccount(Currency $currency): void
    {
        if (!$this->isTheSameCurrencyThanTheAccount($currency)) {
            throw WrongCurrencyOperation::becauseTheCurrencyDiffersFromTheAccount(
                $this->currency,
                $currency
            );
        }
    }

    private function onCheckingAccountWasOpen(CheckingAccountWasOpen $event): void
    {
        $this->ownerId  = $event->ownerId();
        $this->name     = AccountName::fromString($this->number());
        $this->balance  = new Money(0, $event->currency());
        $this->currency = $event->currency();
        $this->register = CheckRegister::createEmpty();
    }

    private function onAccountWasRenamed(AccountWasRenamed $event): void
    {
        $this->name = $event->name();
    }

    private function onDepositWasMade(DepositWasMade $event): void
    {
        $this->register->add($event->deposit());

        $this->balance = $this->balance->add($event->deposit()->amount());
    }

    private function onWithdrawalWasMade(WithdrawalWasMade $event): void
    {
        $this->register->add($event->withdrawal());

        $this->balance = $this->balance->subtract($event->Withdrawal()->amount());
    }
}
