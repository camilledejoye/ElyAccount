<?php

namespace ElyAccount\Domain\Identity\Exception;

/**
 * Factory for UUID related exceptions.
 *
 * @abstract
 */
abstract class UuidException
{
    /**
     * Creates an exception meaning that a string was used as an UUID and was not a valid one.
     *
     * @param string $invalidUuidString
     *
     * @return InvalidUuidStringException
     */
    public static function becauseAStringIsNotAValidUuid(string $invalidUuidString): InvalidUuidStringException
    {
        return new InvalidUuidStringException($invalidUuidString);
    }
}
