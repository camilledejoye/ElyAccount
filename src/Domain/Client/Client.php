<?php

namespace ElyAccount\Domain\Client;

use ElyAccount\Domain\Common\FirstName;
use ElyAccount\Domain\Common\FullName;
use ElyAccount\Domain\Common\LastName;
use ElyAccount\Domain\Common\Person;
use ElyAccount\Domain\Client\ClientName;
use ElyAccount\Domain\Client\ClientId;
use ElyAccount\Domain\Common\Entity;

/**
 * Represents an owner of a bank account.
 *
 * @see Entity
 */
class Client implements Entity, Person
{
    /**
     * @var ClientId
     */
    private $id;

    /**
     * @var ClientName
     */
    private $name;

    public static function signUp(ClientId $id, ClientName $name)
    {
        return new self($id, $name);
    }

    /**
     * {@inheritDoc}
     */
    public function id()
    {
        throw new \RuntimeException('Not yet implemented !');
    }

    /**
     * {@inheritDoc}
     */
    public function lastName(): LastName
    {
        throw new \RuntimeException('Not yet implemented !');
    }

    /**
     * {@inheritDoc}
     */
    public function firstName(): FirstName
    {
        throw new \RuntimeException('Not yet implemented !');
    }

    /**
     * {@inheritDoc}
     */
    public function fullName(): FullName
    {
        throw new \RuntimeException('Not yet implemented !');
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return $this->name->toString();
    }

    /**
     * Initializes a client.
     *
     * @param ClientId $id
     * @param ClientName $name
     */
    public function __construct(ClientId $id, ClientName $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }
}
