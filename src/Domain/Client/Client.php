<?php

namespace ElyAccount\Domain\Client;

use ElyAccount\Domain\Client\Event\ClientHasSignedUp;
use ElyAccount\Domain\Common\FirstName;
use ElyAccount\Domain\Common\FullName;
use ElyAccount\Domain\Common\LastName;
use ElyAccount\Domain\Common\Person;
use ElyAccount\Domain\Client\ClientName;
use ElyAccount\Domain\Client\ClientId;
use ddd\Aggregate\AggregateRoot;
use ddd\Aggregate\BasicAggregateRoot;
use ddd\Event\AggregateChanges;
use ddd\Event\AggregateHistory;

/**
 * Represents an owner of a bank account.
 *
 * @see AggregateRoot
 */
class Client implements AggregateRoot, Person
{
    use BasicAggregateRoot;

    /**
     * @var ClientId
     */
    private $id;

    /**
     * @var ClientName
     */
    private $name;

    /**
     * Sign up a new client.
     *
     * @param ClientId $id
     * @param ClientName $name
     *
     * @return self
     */
    public static function signUp(ClientId $id, ClientName $name)
    {
        $client = new self($id);

        $client->recordThat(ClientHasSignedUp::byName($id, $name));

        return $client;
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
     * {@inheritDoc}
     *
     * @return ClientId
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function lastName(): LastName
    {
        return $this->name->lastName();
    }

    /**
     * {@inheritDoc}
     */
    public function firstName(): FirstName
    {
        return $this->name->firstName();
    }

    /**
     * {@inheritDoc}
     *
     * @return ClientName
     */
    public function fullName(): FullName
    {
        return $this->name;
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
     */
    private function __construct(ClientId $id)
    {
        $this->id = $id;
        $this->pendingEvents = AggregateChanges::createFor($id);
    }

    protected function onClientHasSignedUp(ClientHasSignedUp $event): void
    {
        $this->name = $event->name();
    }
}
