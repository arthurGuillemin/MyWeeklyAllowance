<?php

namespace App;

class Account
{
    private string $name;
    private float $balance;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->balance = 0;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }
}
