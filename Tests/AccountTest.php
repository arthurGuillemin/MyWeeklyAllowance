<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Account;

class AccountTest extends TestCase
{
    private Account $account;

    protected function setUp(): void
    {   
        $name = "Arthur";
        $this->account = new Account($name, "arthur@exazmple.com", 17, "ado");
    }

    public function testCreateAccount(): void
    {
        $this->assertEquals("Arthur", $this->account->getName());
        $this->assertEquals(0, $this->account->getBalance());
        $this->assertEquals("arthur@exazmple.com", $this->account->getEmail());
        $this->assertEquals(17, $this->account->getAge());
        $this->assertEquals("ado", $this->account->getType());
    }

    public function testGetSolde(): void
    {
        $balance = $this->account->getBalance();
        $this->assertEquals(0, $balance);
    }

    public function testNameCannotBeEmpty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Account("");
    }

    public function testAgeCannotBeNegative(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Account("Emy", "emy@exemple.com", -5, "parent");
    }
}
