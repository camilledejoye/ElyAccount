<?php

namespace ElyAccount\Domain\Common;

interface OwnsALastName
{
    /**
     * Gets the last name.
     *
     * @return LastName
     */
    public function lastName(): LastName;
}
