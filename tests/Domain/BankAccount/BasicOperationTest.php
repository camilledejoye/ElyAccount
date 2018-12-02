<?php

namespace ElyAccount\Tests\BankAccount;

use DateTimeImmutable;
use ElyAccount\BankAccount\BasicOperation;
use ElyAccount\BankAccount\Exception\InvalidAmountOperation;
use Money\Money;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class BasicOperationTest extends TestCase
{
    /**
     * @var BasicOperation|MockObject
     */
    private $sut;

    /**
     * @var DateTimeImmutable
     */
    private $date;

    /**
     * @var Money
     */
    private $amount;

    protected function setUp()
    {
        $this->date = DateTimeImmutable::createFromFormat(
            'Y-m-d H:i:s',
            '1959-02-04 18:34:57'
        );
        $this->amount = $this->createAnAmount(46878);

        $this->sut = $this->createASut($this->date, $this->amount);
    }

    /**
     * @test
     * @dataProvider provideInvalidAmounts
     */
    public function shouldRefuseAnInvalidAmount(Money $amount)
    {
        $this->expectException(InvalidAmountOperation::class);

        $sut = $this->createASut(
            $this->createMock(DateTimeImmutable::class),
            $amount
        );
    }

    public function provideInvalidAmounts(): array
    {
        return [
            'negative amount' => [$this->createAnAmount(-4865468)],
            'amount equals to zero' => [$this->createAnAmount(0)],
        ];
    }

    /**
     * @test
     */
    public function shouldOccuredOnADate()
    {
        $this->assertSame($this->date, $this->sut->occuredOn());
    }

    /**
     * @test
     */
    public function shouldProvideAnAmount()
    {
        $this->assertSame($this->amount, $this->sut->amount());
    }

    private function createAnAmount(int $value): Money
    {
        return Money::USD($value);
    }

    private function createASut(DateTimeImmutable $date, Money $amount)
    {
        $sut = $this->getMockBuilder(BasicOperation::class)
            ->setMethods(['now'])
            ->getMockForTrait();
        $sut->method('now')->willReturn($date);

        $reflection = new ReflectionClass($sut);
        $initialize = $reflection->getMethod('initializeTheOperation');
        $initialize->setAccessible(true);
        $initialize->invoke($sut, $amount);

        return $sut;
    }
}
