<?php

namespace ElyAccount\Tests\Domain\Common;

use ElyAccount\Domain\Common\Exception\EmptyLastNameException;
use ElyAccount\Domain\Common\LastName;
use PHPUnit\Framework\TestCase;

class LastNameTest extends TestCase
{
    const LAST_NAME = 'Dejoye';

    /**
     * @test
     */
    public function shouldNotAllowToCreateAnEmptyLastName()
    {
        $this->expectException(EmptyLastNameException::class);
        $this->expectExceptionMessage('A last name can\'t be empty.');

        LastName::fromString('');
    }

    /**
     * @test
     */
    public function shouldProvideTheLastNameAsAstring()
    {
        $this->assertSame(self::LAST_NAME, LastName::fromString(self::LAST_NAME)->toString());
    }

    /**
     * @test
     */
    public function shouldBeConvertibleToString()
    {
        $this->assertSame(self::LAST_NAME, (string) LastName::fromString(self::LAST_NAME));
    }
}
