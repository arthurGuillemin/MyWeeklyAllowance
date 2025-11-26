<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Account;
use App\Transaction;

class TransactionsTest extends TestCase
{
    private Account $account;    
    private Transaction $transaction;

    protected function setUp(): void
    {
        $this->account = new Account("User");
        $this->transaction = new Transaction($this->account);
    }

    public function testDepotAugmenteLeSolde(): void
    {
        $this->transaction->depot($this->account, 50);
        $this->assertEquals(50, $this->account->getBalance(), 'Le solde doit être de 50 après un dépôt de 50');
    }

    public function testDepotsSuccessifs(): void
    {
        $this->transaction->depot($this->account, 30);
        $this->transaction->depot($this->account, 20);
        $this->assertEquals(50, $this->account->getBalance(), 'Le solde doit être de 50 après 30 + 20');
    }

    public function testDepenseDiminueLeSolde(): void
    {
        $this->transaction->depot($this->account, 100);
        $this->transaction->depense($this->account, 30);
        $this->assertEquals(70, $this->account->getBalance(), 'Le solde doit être de 70 après dépense de 30');
    }

    public function testDepensesSuccessives(): void
    {
        $this->transaction->depot($this->account, 100);
        $this->transaction->depense($this->account, 20);
        $this->transaction->depense($this->account, 30);
        $this->assertEquals(50, $this->account->getBalance(), 'Le solde doit être de 50 après 100 - 20 - 30');
    }

    public function testScenarioComplet(): void
    {
        $this->transaction->depot($this->account, 100);
        $this->transaction->depense($this->account, 30);
        $this->transaction->depot($this->account, 50);
        $this->transaction->depense($this->account, 20);
        $this->assertEquals(100, $this->account->getBalance(), 'Le solde final doit être de 100');
    }
}
