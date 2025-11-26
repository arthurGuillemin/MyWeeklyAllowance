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
}
