<?php

namespace ElyAccount\Domain\BankAccount;

use ElyAccount\Domain\BankAccount\Exception\EmptyAccountName;

/**
 * A name for an account.
 */
class AccountName
{
    /**
     * @var string
     */
    private $name;

    /**
     * Create an account name from a string.
     *
     * @param string $name
     *
     * @return AccountName
     *
     * @throws EmptyAccountName
     */
    public static function fromString(string $name): AccountName
    {
        return new self($name);
    }

    /**
     * Gets the name of an account as a string.
     *
     * @return string
     */
    public function toString(): string
    {
        return $this->name;
    }

    /**
     * Gets the name of an account as a string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Initialize an account name.
     *
     * @param string $name
     *
     * @throws EmptyAccountName
     */
    private function __construct(string $name)
    {
        if ('' === trim($name)) {
            throw EmptyAccountName::becauseAnACcountNameCantBeEmpty();
        }

        $this->name = $name;
    }
}
