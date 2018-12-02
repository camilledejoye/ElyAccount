<?php

namespace ElyAccount\Common;

interface OwnsALastName
{
    /**
     * Gets the last name.
     *
     * @return LastName
     */
    public function lastName(): LastName;
}
