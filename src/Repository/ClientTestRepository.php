<?php

namespace App\Repository;

use ElyAccount\Client\Client;
use ElyAccount\Client\ClientId;
use ElyAccount\Client\ClientRepository;

class ClientTestRepository implements ClientRepository
{
    /**
     * {@inheritDoc}
     */
    public function get(ClientId $id)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function save(Client $client)
    {
        dump(sprintf('client "%s" saved', $client));
    }
}
