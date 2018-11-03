<?php

namespace ElyAccount\Domain\Common;

interface OwnsAFirstName
{
    /**
     * Gets the first name.
     *
     * @return FirstName
     */
    public function firstName(): FirstName;
}
