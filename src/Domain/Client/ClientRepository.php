<?php

namespace ElyAccount\Client;

use ElyAccount\Client\ClientId;
use ElyAccount\Client\Client;

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
