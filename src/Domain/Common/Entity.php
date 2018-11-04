<?php

namespace ElyAccount\Domain\Common;

use ElyAccount\Domain\Common\IdentifiesEntities;

interface Entity
{
    /**
     * Gets the identity of an entity
     *
     * @return IdentifiesEntities
     */
    public function id();
}
