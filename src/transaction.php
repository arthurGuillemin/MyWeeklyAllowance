<?php

declare(strict_types=1);

namespace App;

use App\Exception\MontantInvalideException;
use App\Exception\SoldeInsuffisantException;

class Transaction
{

private Account $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    
    public function depot(Account $account, float $montant): void
    {
        if ($montant <= 0) {
            throw new MontantInvalideException("Le montant du dépôt doit être positif");
        }

        $account->addBalance($montant);
    }

    public function depense(Account $account, float $montant): void
    {
        if ($montant <= 0) {
            throw new MontantInvalideException("Le montant de la dépense doit être positif");
        }

        if ($account->getBalance() - $montant < 0) {
            throw new SoldeInsuffisantException("Solde insuffisant pour effectuer cette dépense");
        }

        $account->subtractBalance($montant);
    }
}