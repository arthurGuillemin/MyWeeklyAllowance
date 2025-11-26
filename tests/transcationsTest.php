<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Account;
use App\Transaction;
use App\Exception\MontantInvalideException;
use App\Exception\SoldeInsuffisantException;

/**
 * Class TransactionTest
 *
 * Tests unitaires pour les transactions (dépôt et dépense) - DEV B
 * 
 * Chaque test suit le pattern AAA :
 *  - Arrange : préparation des données
 *  - Act     : exécution de la méthode à tester
 *  - Assert  : vérification du résultat
 *
 * Et respecte le principe FIRST :
 *  - Fast, Independent, Repeatable, Self-validating, Timely
 */
class TranscationsTest extends TestCase
{
    private Account $account;    
    private Transaction $transaction;

    /**
     * setUp() est appelée avant chaque test pour garantir l'isolation (FIRST - Independent).
     */
    protected function setUp(): void
    {
        $this->account = new Account("User");
        $this->transaction = new Transaction($this->account);
    }

    /**
     * Teste qu'un dépôt augmente bien le solde
     */
    public function testDepotAugmenteLeSolde(): void
    {
        // Arrange
        $montant = 50;

        // Act
        $this->transaction->depot($montant);

        // Assert
        $this->assertEquals(50, $this->account->getBalance(), 'Le solde doit être de 50 après un dépôt de 50');
    }

    /**
     * Teste plusieurs dépôts successifs
     */
    public function testDepotsSuccessifs(): void
    {
        // Arrange & Act
        $this->transaction->depot(30);
        $this->transaction->depot(20);

        // Assert
        $this->assertEquals(50, $this->account->getBalance(), 'Le solde doit être de 50 après 30 + 20');
    }

    /**
     * Teste qu'un dépôt avec montant négatif lève une exception
     */
    public function testDepotNegatifLeveException(): void
    {
        // Assert
        $this->expectException(MontantInvalideException::class);

        // Act
        $this->transaction->depot(-10);
    }

    /**
     * Teste qu'un dépôt avec montant zéro lève une exception
     */
    public function testDepotZeroLeveException(): void
    {
        // Assert
        $this->expectException(MontantInvalideException::class);

        // Act
        $this->transaction->depot(0);
    }

    /**
     * Teste qu'une dépense diminue bien le solde
     */
    public function testDepenseDiminueLeSolde(): void
    {
        // Arrange
        $this->transaction->depot(100);

        // Act
        $this->transaction->depense(30);

        // Assert
        $this->assertEquals(70, $this->account->getBalance(), 'Le solde doit être de 70 après dépense de 30');
    }

    /**
     * Teste plusieurs dépenses successives
     */
    public function testDepensesSuccessives(): void
    {
        // Arrange
        $this->transaction->depot(100);

        // Act
        $this->transaction->depense(20);
        $this->transaction->depense(30);

        // Assert
        $this->assertEquals(50, $this->account->getBalance(), 'Le solde doit être de 50 après 100 - 20 - 30');
    }

    /**
     * Teste qu'une dépense avec montant négatif lève une exception
     */
    public function testDepenseNegativeLeveException(): void
    {
        // Arrange
        $this->transaction->depot(50);

        // Assert
        $this->expectException(MontantInvalideException::class);

        // Act
        $this->transaction->depense(-10);
    }

    /**
     * Teste qu'une dépense avec montant zéro lève une exception
     */
    public function testDepenseZeroLeveException(): void
    {
        // Arrange
        $this->transaction->depot(50);

        // Assert
        $this->expectException(MontantInvalideException::class);

        // Act
        $this->transaction->depense(0);
    }

    /**
     * Teste qu'une dépense avec solde insuffisant lève une exception
     */
    public function testDepenseAvecSoldeInsuffisantLeveException(): void
    {
        // Arrange
        $this->transaction->depot(20);

        // Assert
        $this->expectException(SoldeInsuffisantException::class);

        // Act
        $this->transaction->depense(50);
    }

    /**
     * Teste qu'on ne peut pas dépenser avec un solde à zéro
     */
    public function testDepenseSurCompteVideLeveException(): void
    {
        // Assert
        $this->expectException(SoldeInsuffisantException::class);

        // Act
        $this->transaction->depense(10);
    }

    /**
     * Teste un scénario complet : dépôts et dépenses mixtes
     */
    public function testScenarioComplet(): void
    {
        // Arrange & Act
        $this->transaction->depot(100);
        $this->transaction->depense(30);
        $this->transaction->depot(50);
        $this->transaction->depense(20);

        // Assert
        $this->assertEquals(100, $this->account->getBalance(), 'Le solde final doit être de 100');
    }
}