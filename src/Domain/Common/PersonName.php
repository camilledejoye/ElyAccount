<?php

namespace ElyAccount\Common;

/**
 * Represents a last name and a first name.
 */
trait PersonName
{
    /**
     * @var FirstName
     */
    private $firstName;

    /**
     * @var LastName
     */
    private $lastName;

    /**
     * Gets the first name.
     *
     * @return FirstName
     */
    public function firstName(): FirstName
    {
        return $this->firstName;
    }

    /**
     * {@inheritdoc}
     */
    public function lastName(): LastName
    {
        return $this->lastName;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return sprintf('%s %s', $this->firstName, $this->lastName);
    }

    /**
     * Initializes a name.
     *
     * @param FirstName $firstName
     * @param LastName $lastName
     *
     * @return void
     */
    private function initializeTheName(FirstName $firstName, LastName $lastName): void
    {
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
    }
}
