<?php

namespace ElyAccount\Domain\Client\Event;

use DateTimeImmutable;
use ElyAccount\Domain\Client\ClientId;
use ElyAccount\Domain\Client\ClientName;
use ddd\Event\DomainEvent;

/**
 * Event emmited when a client signs up.
 *
 * @see DomainEvent
 * @final
 */
final class ClientHasSignedUp implements DomainEvent
{
    /**
     * @var ClientId
     */
    private $aggregateId;

    /**
     * @var ClientName
     */
    private $name;

    /**
     * @var DateTimeImmutable
     */
    private $occuredOn;

    /**
     * Signs up a client by his name.
     *
     * @param ClientId $aggregateId
     * @param ClientName $name
     *
     * @return ClientHasSignedUp
     */
    public static function byName(ClientId $aggregateId, ClientName $name): ClientHasSignedUp
    {
        return new self($aggregateId, $name);
    }

    /**
     * Gets the name used by a client to sign up.
     *
     * @return ClientName
     */
    public function name(): ClientName
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function occuredOn()
    {
        return $this->occuredOn;
    }

    /**
     * {@inheritDoc}
     *
     * @return ClientId
     */
    public function aggregateId()
    {
        return $this->aggregateId;
    }

    protected function __construct(ClientId $aggregateId, ClientName $name)
    {
        $this->aggregateId = $aggregateId;
        $this->name = $name;
        $this->occuredOn = new DateTimeImmutable();
    }
}
