<?php

namespace ElyAccount\Client;

use ElyAccount\Common\FirstName;
use ElyAccount\Common\LastName;
use ElyAccount\Common\Name;
use ElyAccount\Common\PersonName;

final class ClientName implements Name
{
    use PersonName;

    /**
     * Creates a client name from the first and last names as strings.
     *
     * @param string $firstName
     * @param string $lastName
     *
     * @return self
     *
     * @throws EmptyFirstName
     * @throws EmptyLastName
     */
    public static function fromStrings(string $firstName, string $lastName): self
    {
        return static::fromNames(
            FirstName::fromString($firstName),
            LastName::fromString($lastName)
        );
    }

    /**
     * Creates a client name from a FirstName and LastName object.s
     *
     * @param FirstName $firstName
     * @param LastName $lastName
     *
     * @return self
     */
    public static function fromNames(FirstName $firstName, LastName $lastName): self
    {
        return new static($firstName, $lastName);
    }

    /**
     * Initializes a client name.
     *
     * @param FirstName $firstName
     * @param LastName $lastName
     */
    private function __construct(FirstName $firstName, LastName $lastName)
    {
        $this->initializeTheName($firstName, $lastName);
    }
}
