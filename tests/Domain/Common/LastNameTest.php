<?php

namespace ElyAccount\Tests\Domain\Common;

use ElyAccount\Domain\Common\Exception\EmptyLastName;
use ElyAccount\Domain\Common\LastName;
use PHPUnit\Framework\TestCase;

class LastNameTest extends TestCase
{
    const LAST_NAME = 'Dejoye';

    /**
     * @test
     * @dataProvider provideEmptyLastNames
     */
    public function shouldNotAllowToCreateAnEmptyLastName(string $emptyLastName)
    {
        $this->expectException(EmptyLastName::class);
        $this->expectExceptionMessage('A last name can\'t be empty.');

        LastName::fromString($emptyLastName);
    }

    public function provideEmptyLastNames(): array
    {
        return [
            'empty strings' => [''],
            'spaces' => ['   '],
            'tabulations' => ['		'],
            'mixed of spaces and tabulations' => [' 	  '],
        ];
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
