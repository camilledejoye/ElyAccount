<?php

namespace ElyAccount\Tests\Domain\BankAccount;

use ElyAccount\Domain\BankAccount\AccountName;
use ElyAccount\Domain\BankAccount\Exception\EmptyAccountName;
use PHPUnit\Framework\TestCase;

class AccountNameTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideEmptyNames
     */
    public function shouldNotAcceptEmptyNames(string $consideredAsEmpty)
    {
        $this->expectException(EmptyAccountName::class);
        $this->expectExceptionMessage('An account name can not be empty.');

        AccountName::fromString($consideredAsEmpty);
    }

    public function provideEmptyNames(): array
    {
        return [
            'empty string'                    => [''],
            'only spaces'                     => ['   '],
            'only tabulations'                => ['		'],
            'mixed of spaces and tabulations' => [' 	  	'],
        ];
    }

    /**
     * @test
     * @dataProvider provideNonEmptyNames
     */
    public function shouldCreateAnAccountName(string $notEmptyName)
    {
        $name = AccountName::fromString($notEmptyName);

        $this->assertEquals($notEmptyName, (string) $name);
    }

    public function provideNonEmptyNames(): array
    {
        return [
            'any string'       => ['dsjf'],
            'the string "0"'   => ['0'],
            'the string "0.0"' => ['0.0'],
        ];
    }
}
