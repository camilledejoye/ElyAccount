<?php

namespace ElyAccount\Domain\Common;

interface GeneratesIdentities
{
    /**
     * Generates an identity.
     *
     * @return IdentifiesEntities
     */
    public static function generate();
}
