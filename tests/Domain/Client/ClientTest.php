<?php

namespace ElyAccount\Tests\Domain\Client;

use ElyAccount\Domain\Client\Client;
use ElyAccount\Domain\Client\ClientId;
use ElyAccount\Domain\Client\ClientName;
use ElyAccount\Domain\Common\FirstName;
use ElyAccount\Domain\Common\LastName;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    const LAST_NAME = 'Wayne';
    const FIRST_NAME = 'Bruce';
    const NAME = self::FIRST_NAME . ' ' . self::LAST_NAME;


    /**
     * @var Client
     */
    private $sut;

    /**
     * @var ClientId
     */
    private $id;

    /**
     * @var FirstName
     */
    private $firstName;

    /**
     * @var LastName
     */
    private $lastName;

    /**
     * @var ClientName
     */
    private $name;

    protected function setUp()
    {
        $this->id = $this->createAClientId();
        $this->firstName = FirstName::fromString(self::FIRST_NAME);
        $this->lastName = LastName::fromString(self::LAST_NAME);
        $this->name = ClientName::fromNames($this->firstName, $this->lastName);
        $this->sut = Client::signUp($this->id, $this->name);
    }

    /**
     * @test
     */
    public function shouldSignUpAClient()
    {
        $this->assertInstanceOf(Client::class, $this->sut);
    }

    /**
     * @test
     */
    public function shoulProvideAFirstName()
    {
        $this->assertSame($this->firstName, $this->sut->firstName());
    }

    /**
     * @test
     */
    public function shoulProvideALastName()
    {
        $this->assertSame($this->lastName, $this->sut->lastName());
    }

    /**
     * @test
     */
    public function shouldProvideAName()
    {
        $this->assertSame($this->name, $this->sut->name());
    }

    /**
     * @test
     */
    public function shouldProvideAnIdentity()
    {
        $this->assertSame($this->id, $this->sut->id());
    }

    private function createAClientId(): ClientId
    {
        return ClientId::generate();
    }
}
