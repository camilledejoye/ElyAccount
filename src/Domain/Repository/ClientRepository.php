<?php

namespace ElyAccount\Domain\Repository;

use ElyAccount\Domain\Common\IdentifiesEntities;
use ElyAccount\Domain\Client\ClientId;
use ElyAccount\Domain\Common\Entity;
use ElyAccount\Domain\Client\Client;

interface ClientRepository extends EntityRepository
{
    /**
     * {@inheritdoc}
     *
     * @param ClientId $id
     *
     * @return Client
     */
    public function get(IdentifiesEntities $id);

    /**
     * {@inheritdoc}
     *
     * @param Client $client
     *
     * @return static
     */
    public function manage(Entity $client);

    /**
     * {@inheritdoc}
     *
     * @return static
     */
    public function save();
}
