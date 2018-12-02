<?php

namespace ElyAccount\BankAccount;

use DateTimeImmutable;
use Money\Money;

/**
 * Represents a deposit or a withdrawal.
 */
interface Operation
{
    /**
     * When the opereation was operated.
     *
     * @return DateTimeImmutable
     */
    public function occuredOn();

    /**
     * The amount of the operation.
     *
     * @return Money
     */
    public function amount(): Money;
}
