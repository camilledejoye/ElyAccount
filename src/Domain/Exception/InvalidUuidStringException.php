<?php

namespace ElyAccount\Domain\Exception;

/**
 * Thrown when trying to use a string as an UUID when it is not.
 *
 * @see \DomainException
 * @final
 */
final class InvalidUuidStringException extends \DomainException
{
    /**
     * {@inheritdoc}
     *
     * @param string $invalidUuidString
     */
    public function __construct(string $invalidUuidString)
    {
        parent::__construct(
            sprintf('The string "%s" is not a valid UUID.', $invalidUuidString)
        );
    }
}
