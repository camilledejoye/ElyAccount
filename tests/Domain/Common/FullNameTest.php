<?php

namespace ElyAccount\Tests\Domain\Common;

use ElyAccount\Domain\Common\Exception\EmptyFirstNameException;
use ElyAccount\Domain\Common\Exception\EmptyLastNameException;
use ElyAccount\Domain\Common\FirstName;
use ElyAccount\Domain\Common\LastName;
use ElyAccount\Domain\Common\FullName;
use PHPUnit\Framework\TestCase;

class FullNameTest extends TestCase
{
    const LASTNAME  = 'Remi';
    const FIRSTNAME = 'Alexis';
    const FULLNAME  = self::FIRSTNAME . ' ' . self::LASTNAME;

    /**
     * @var PersonName
     */
    private $sut;

    /**
     * @var LastName
     */
    private $lastName;

    /**
     * @var FirstName
     */
    private $firstName;

    protected function setUp()
    {
        $this->lastName  = LastName::fromString(self::LASTNAME);
        $this->firstName = FirstName::fromString(self::FIRSTNAME);
        $this->sut       = FullName::fromNames($this->lastName, $this->firstName);
    }

    /**
     * @test
     */
    public function shouldNotAllowedEmptyLastName()
    {
        $this->expectException(EmptyLastNameException::class);

        FullName::fromStrings('', 'not empty');
    }

    /**
     * @test
     */
    public function shouldNotAllowedEmptyFirstName()
    {
        $this->expectException(EmptyFirstNameException::class);

        FullName::fromStrings('not empty', '');
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
    public function shouldProvideAStringRepresentation()
    {
        $this->assertSame(self::FULLNAME, $this->sut->toString());
    }

    /**
     * @test
     */
    public function shouldBeConvertibleToString()
    {
        $this->assertSame(self::FULLNAME, (string) $this->sut);
    }
}
