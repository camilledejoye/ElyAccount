<?php

namespace ElyAccount\Domain\Client;

use ElyAccount\Domain\Client\ClientId;
use ElyAccount\Domain\Client\Client;

interface ClientRepository
{
    /**
     * Gets a client from it's identity.
     *
     * @param ClientId $id
     *
     * @return Client
     */
    public function get(ClientId $id);

    /**
     * Save a client.
     *
     * @param Client $client
     *
     * @return static
     */
    public function save(Client $client);
}
