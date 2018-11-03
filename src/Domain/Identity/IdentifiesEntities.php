<?php

namespace ElyAccount\Domain\Identity;

interface IdentifiesEntities
{
    /**
     * Creates an identity from a string representation.
     *
     * @param string $value
     *
     * @return static
     */
    public static function fromString(string $value);

    /**
     * Compares a value to an identity.
     * To be equals, two identities must have the same type and value.
     *
     * @param mixed $other
     *
     * @return bool
     */
    public function equals($other): bool;

    /**
     * Returns the string representatio of the identity.
     *
     * @return string
     */
    public function __toString(): string;
}
