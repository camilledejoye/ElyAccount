<?php

namespace ElyAccount\Domain\Common;

interface Person extends OwnsAFullName
{
    /**
     * Gets the last name of a person.
     *
     * @return LastName
     */
    public function lastName(): LastName;

    /**
     * Gets the first name of a person.
     *
     * @return FirstName
     */
    public function firstName(): FirstName;

    /**
     * Gets the full name of a person.
     *
     * @return FullName
     */
    public function fullName(): FullName;

    /**
     * Gets the string representation of a person.
     *
     * @return string
     */
    public function __toString(): string;
}
