<?php

namespace ElyAccount\Domain\Common;

/**
 * Represents a last name and a first name.
 */
class FullName
{
    /**
     * @var LastName
     */
    private $lastName;

    /**
     * @var FirstName
     */
    private $firstName;

    /**
     * Creates a person name from the last and first name as strings.
     *
     * @param string $lastName
     * @param string $firstName
     *
     * @return static
     *
     * @throws EmptyLastNameException
     * @throws EmptyFirstNameException
     */
    public static function fromStrings(string $lastName, string $firstName)
    {
        return static::fromNames(
            LastName::fromString($lastName),
            FirstName::fromString($firstName)
        );
    }

    /**
     * Creates a person name from a LastName and a FirstName objects.
     *
     * @param LastName $lastName
     * @param FirstName $firstName
     *
     * @return static
     */
    public static function fromNames(LastName $lastName, FirstName $firstName)
    {
        return new static($lastName, $firstName);
    }

    /**
     * Gets the last name of a person name.
     *
     * @return LastName
     */
    public function lastName(): LastName
    {
        return $this->lastName;
    }

    /**
     * Gets the first name of a person name.
     *
     * @return FirstName
     */
    public function firstName(): FirstName
    {
        return $this->firstName;
    }

    /**
     * Gets a person name as a string.
     *
     * @return string
     */
    public function toString(): string
    {
        return sprintf('%s %s', $this->firstName, $this->lastName);
    }

    /**
     * Gets the string representation of a person name.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Initializes a persone name.
     *
     * @param LastName $lastName
     * @param FirstName $firstName
     */
    private function __construct(LastName $lastName, FirstName $firstName)
    {
        $this->lastName  = $lastName;
        $this->firstName = $firstName;
    }
}
