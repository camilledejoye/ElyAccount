<?php

namespace ElyAccount\Common;

interface OwnsAFirstName
{
    /**
     * Gets the first name.
     *
     * @return FirstName
     */
    public function firstName(): FirstName;
}
