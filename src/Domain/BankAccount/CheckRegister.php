<?php

namespace ElyAccount\Domain\BankAccount;

use Countable;

class CheckRegister implements Countable
{
    /**
     * @var Operation[]
     */
    private $operations;

    /**
     * Creates an empty checkregister.
     *
     * @return self
     */
    public static function createEmpty(): self
    {
        return new self();
    }

    /**
     * Adds an operation to a checkregister.
     *
     * @param Operation $operation
     *
     * @return self
     */
    public function add(Operation $operation): self
    {
        $this->operations[] = $operation;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function count()
    {
        return count($this->operations);
    }

    private function __construct()
    {
        $this->operations = [];
    }
}
