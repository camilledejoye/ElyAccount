<?php

namespace ElyAccount\Client\Event;

use ElyAccount\Client\ClientId;
use ElyAccount\Client\ClientName;
use ddd\Event\BasicDomainEvent;
use ddd\Event\DomainEvent;

/**
 * Event emmited when a client signs up.
 *
 * @see DomainEvent
 * @final
 */
final class ClientHasSignedUp implements DomainEvent
{
    use BasicDomainEvent;

    /**
     * @var ClientName
     */
    private $name;

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
     * Initializes the event.
     *
     * @param ClientId $aggregateId
     * @param ClientName $name
     */
    protected function __construct(ClientId $aggregateId, ClientName $name)
    {
        $this->initializeTheEvent($aggregateId);
        $this->name = $name;
    }
}
