<?php

namespace ElyAccount\Domain\Common;

interface Name
{
    /**
     * Gets the name as a string.
     *
     * @return string
     */
    public function __toString(): string;
}
