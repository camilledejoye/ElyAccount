<?php

namespace ElyAccount\Tests\Common;

use ElyAccount\Common\Exception\EmptyFirstName;
use ElyAccount\Common\FirstName;
use PHPUnit\Framework\TestCase;

class FirstNameTest extends TestCase
{
    const FIRST_NAME = 'Dejoye';

    /**
     * @test
     * @dataProvider provideEmptyFirstNames
     */
    public function shouldNotAllowToCreateAnEmptyFirstName(string $emptyFirstName)
    {
        $this->expectException(EmptyFirstName::class);
        $this->expectExceptionMessage('A first name can\'t be empty.');

        FirstName::fromString($emptyFirstName);
    }

    public function provideEmptyFirstNames(): array
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
    public function shouldProvideTheFirstNameAsAstring()
    {
        $this->assertSame(self::FIRST_NAME, FirstName::fromString(self::FIRST_NAME)->toString());
    }

    /**
     * @test
     */
    public function shouldBeConvertibleToString()
    {
        $this->assertSame(self::FIRST_NAME, (string) FirstName::fromString(self::FIRST_NAME));
    }
}
