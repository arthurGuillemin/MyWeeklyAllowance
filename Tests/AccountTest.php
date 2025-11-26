<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Account;

class AccountTest extends TestCase
{
    private Account $account;

      /**
     * setUp() est appelée avant chaque test pour garantir l’isolation (FIRST - Independent).
     */
    protected function setUp(): void
    {   
        $name = "Arthur";
        $this->account = new Account($name);
    }

    public function testCreateAccount(): void
    {
      //Assert
        $this->assertEquals("Arthur", $this->account->getName());
        $this->assertSame(0, $this->account->getBalance());
    }

    public function testGetSolde(): void
    {
        // Act
        $balance = $this->account->getBalance();

        // Assert
        $this->assertSame(0, $balance);
    }
}
