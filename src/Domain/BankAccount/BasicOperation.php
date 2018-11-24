<?php

namespace ElyAccount\Domain\BankAccount;

use DateTimeImmutable;
use ElyAccount\Domain\BankAccount\Exception\InvalidAmountOperation;
use Money\Money;

/**
 * Basic implementation of an operation.
 *
 * @see Operation
 */
trait BasicOperation
{
    /**
     * @var DateTimeImmutable
     */
    private $date;

    /**
     * @var Money
     */
    private $amount;

    /**
     * {@inheritdoc}
     */
    public function occuredOn()
    {
        return $this->date;
    }

    /**
     * {@inheritdoc}
     */
    public function amount(): Money
    {
        return $this->amount;
    }

    /**
     * Initializes an operation.
     *
     * @param Money $amount
     *
     * @return void
     *
     * @throws InvalidAmountOperation
     */
    protected function initializeTheOperation(Money $amount): void
    {
        $this->assertThatAnAmountIsGreaterThanZero($amount);

        $this->date   = $this->now();
        $this->amount = $amount;
    }

    /**
     * Gets the current date time.
     * Allows the trait to be testable.
     *
     * @return DateTimeImmutable
     */
    protected function now(): DateTimeImmutable
    {
        return new DateTimeImmutable();
    }

    /**
     * Guards that an amount is greater than zero.
     *
     * @param Money $amount
     *
     * @return void
     *
     * @throws InvalidAmountOperation
     */
    protected function assertThatAnAmountIsGreaterThanZero(Money $amount)
    {
        if ($amount->isNegative() || '0' === $amount->getAmount()) {
            throw InvalidAmountOperation::becauseAnAmountMustBeGreaterThanZero($amount->getAmount());
        }
    }
}
