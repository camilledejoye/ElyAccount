<?php

namespace ElyAccount\Tests\Domain\Client;

use ElyAccount\Domain\Client\Client;
use ElyAccount\Domain\Client\ClientId;
use ElyAccount\Domain\Client\ClientName;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * @test
     */
    public function shouldSignUpAClient()
    {
        $id = $this->createAClientId();
        $name = $this->createAClientName('Wayne', 'Bruce');
        $sut = Client::signUp($id, $name);

        $this->assertEquals('Bruce Wayne', $sut);
    }

    private function createAClientId(): ClientId
    {
        return ClientId::generate();
    }

    private function createAClientName(string $lastName, string $firstName): ClientName
    {
        return ClientName::fromStrings($lastName, $firstName);
    }
}
