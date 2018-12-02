<?php

namespace ElyAccount\Common;

use ElyAccount\Common\Exception\EmptyLastName;

/**
 * Represents a last name.
 *
 * @final
 */
final class LastName implements Name
{
    /**
     * @var string
     */
    private $lastName;

    /**
     * Creates a LastName from a string.
     *
     * @param string $lastName
     *
     * @return self
     *
     * @throws EmptyLastName
     */
    public static function fromString(string $lastName): self
    {
        return new self(trim($lastName));
    }

    /**
     * Gets the last name as a string.
     *
     * @return string
     */
    public function toString(): string
    {
        return $this->lastName;
    }

    /**
     * Gets the string representation of a last name.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Initializes a LastName object.
     *
     * @param string $lastName
     *
     * @throws EmptyLastName
     */
    private function __construct(string $lastName)
    {
        self::assertThatALastNameIsNotEmpty($lastName);

        $this->lastName = $lastName;
    }

    /**
     * Asserts that a given last name is not empty.
     *
     * @param string $lastName
     *
     * @throws EmptyLastName
     */
    private static function assertThatALastNameIsNotEmpty(string $lastName)
    {
        if (empty($lastName)) {
            throw EmptyLastName::becauseALastNameCantBeEmpty();
        }
    }
}
