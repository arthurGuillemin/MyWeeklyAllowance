<?php
declare(strict_types=1);
namespace App;

class WeeklyAllowance
{
    private float $allowance = 0;
    private float $simulation = 0;

    /* def alloc hebdo */
    public function setAllowance(float $amount): float
    {
        $this->allowance = $amount;
        return $this->allowance;
    }

    /* simule alloc */
    public function simuler(float $amount): float
    {
        $this->simulation = $amount;
        return $this->simulation;
    }

    /* recup montant alloc */
    public function getAllowance(): float
    {
        return $this->allowance;
    }

    /* recup montant simiuler */
    public function getSimulation(): float
    {
        return $this->simulation;
    }

    /* ajout alloc sur compte */
    public function applyToAccount(Account $account): float
    {
        return $account->addBalance($this->allowance);
    }

    /* applique simulation au compte */
    public function applySimulationToAccount(Account $account): float
    {
        return $account->addBalance($this->simulation);
    }
}
