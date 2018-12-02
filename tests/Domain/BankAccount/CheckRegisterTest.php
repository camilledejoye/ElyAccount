<?php

namespace ElyAccount\Tests\BankAccount;

use ElyAccount\BankAccount\CheckRegister;
use ElyAccount\BankAccount\Operation;
use PHPUnit\Framework\TestCase;

class CheckRegisterTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateAnEmptyCheckRegister()
    {
        $sut = CheckRegister::createEmpty();

        $this->assertCount(0, $sut);

        return $sut;
    }

    /**
     * @test
     * @depends shouldCreateAnEmptyCheckRegister
     */
    public function shouldAddAnOperation(CheckRegister $sut)
    {
        $sut->add($this->createAnOperation());

        $this->assertCount(1, $sut);
    }

    private function createAnOperation(): Operation
    {
        return $this->createMock(Operation::class);
    }
}
