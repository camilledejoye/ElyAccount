<?php

namespace ElyAccount\Domain\Repository;

use ElyAccount\Domain\Common\IdentifiesEntities;
use ElyAccount\Domain\Common\Entity;

/**
 * Interface for all repositories.
 */
interface EntityRepository
{
    /**
     * Gets an entity from it's identity.
     *
     * @param IdentifiesEntities $id
     *
     * @return Entity
     */
    public function get(IdentifiesEntities $id);

    /**
     * Let a repository manages an entity.
     *
     * @param Entity $entity
     *
     * @return static
     */
    public function manage(Entity $entity);

    /**
     * Saves the entities managed by a repository.
     *
     * @return static
     */
    public function save();
}
