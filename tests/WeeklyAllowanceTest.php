<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\WeeklyAllowance;

class WeeklyAllowanceTest extends TestCase
{
    private WeeklyAllowance $allowance;
    protected function setUp(): void
    {
        $this->allowance = new WeeklyAllowance();
    }
    public function testDefAlloc(): void
    {
        $result = $this->allowance->setAllowance(10);
        $this->assertEquals(10, $result, 'Alloc hebdomadaire doit être définie à 10');
    }

    public function testSimulerAlloc(): void
    {
        $result = $this->allowance->simuler(5);
        $this->assertEquals(5, $result, 'simulation doit être 5 après ajout 5');
    }

    public function testGetAllowance(): void
    {
        $this->allowance->setAllowance(15);
        $result = $this->allowance->getAllowance();
        $this->assertEquals(15, $result, 'getAllowance doit retourner 15');
    }

    public function testGetSimulation(): void
    {
        $this->allowance->simuler(20);
        $result = $this->allowance->getSimulation();
        $this->assertEquals(20, $result, 'getSimulation doit retourner 20');
    }
}
