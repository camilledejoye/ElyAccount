<?php

namespace ElyAccount\Common;

interface OwnsAName
{
    /**
     * Gets the name.
     *
     * @return Name
     */
    public function name(): Name;

    /**
     * Gets the name as a string.
     *
     * @return string
     */
    public function __toString(): string;
}
