<?php

namespace ElyAccount\Tests\Client;

use ElyAccount\Client\ClientName;
use ElyAccount\Common\Exception\EmptyFirstName;
use ElyAccount\Common\Exception\EmptyLastName;
use ElyAccount\Common\FirstName;
use ElyAccount\Common\LastName;
use PHPUnit\Framework\TestCase;

class ClientNameTest extends TestCase
{
    const FIRST_NAME = 'Neal';
    const LAST_NAME  = 'Caffrey';
    const FULL_NAME  = self::FIRST_NAME . ' ' . self::LAST_NAME;

    /**
     * @var ClientName
     */
    private $sut;

    /**
     * @var FirstName
     */
    private $firstName;

    /**
     * @var LastName
     */
    private $lastName;

    protected function setUp()
    {
        $this->firstName = FirstName::fromString(self::FIRST_NAME);
        $this->lastName  = LastName::fromString(self::LAST_NAME);
        $this->sut       = ClientName::fromNames($this->firstName, $this->lastName);
    }

    /**
     * @test
     * @dataProvider provideEmptyNames
     */
    public function shouldNotAllowedEmptyFirstName(string $emptyFirstName)
    {
        $this->expectException(EmptyFirstName::class);

        ClientName::fromStrings($emptyFirstName, 'not empty');
    }

    /**
     * @test
     * @dataProvider provideEmptyNames
     */
    public function shouldNotAllowedEmptyLastName(string $emptyLastName)
    {
        $this->expectException(EmptyLastName::class);

        ClientName::fromStrings('not empty', $emptyLastName);
    }

    public function provideEmptyNames(): array
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
    public function shouldProvideALastName()
    {
        $this->assertSame($this->lastName, $this->sut->lastName());
    }

    /**
     * @test
     */
    public function shouldProvideAFirstName()
    {
        $this->assertSame($this->firstName, $this->sut->firstName());
    }

    /**
     * @test
     */
    public function shouldBeConvertibleToString()
    {
        $this->assertSame(self::FULL_NAME, (string) $this->sut);
    }
}
