<?php

namespace ElyAccount\Common;

use ElyAccount\Common\Exception\EmptyFirstName;

/**
 * Represents a first name.
 *
 * @final
 */
final class FirstName implements Name
{
    /**
     * @var string
     */
    private $firstName;

    /**
     * Creates a FirstName from a string.
     *
     * @param string $firstName
     *
     * @return self
     *
     * @throws EmptyFirstName
     */
    public static function fromString(string $firstName): self
    {
        return new self(trim($firstName));
    }

    /**
     * Get the first name as a string.
     *
     * @return string
     */
    public function toString(): string
    {
        return $this->firstName;
    }

    /**
     * Gets the string representation of a first name.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Initializes a FirstName object.
     *
     * @param string $firstName
     *
     * @throws EmptyFirstName
     */
    private function __construct(string $firstName)
    {
        self::assertThatAFirstNameIsNotEmpty($firstName);

        $this->firstName = $firstName;
    }

    /**
     * Asserts that a given first name is not empty.
     *
     * @param string $firstName
     *
     * @throws EmptyFirstName
     */
    private static function assertThatAFirstNameIsNotEmpty(string $firstName)
    {
        if (empty($firstName)) {
            throw EmptyFirstName::becauseAFirstNameCantBeEmpty();
        }
    }
}
