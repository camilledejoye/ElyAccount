<?php

namespace ElyAccount\Domain\Identity;

interface GeneratesIdentities
{
    /**
     * Generates an identity.
     *
     * @return IdentifiesEntities
     */
    public static function generate();
}
