<?php

namespace App;

class Account
{
    private string $name;
    private float $balance;

    private ?string $email;       
    private ?int $age;           
    private ?string $type;        

    public function __construct(
        string $name,
        ?string $email = null,
        ?int $age = null,
        ?string $type = null
    ) {
        $this->guardName($name);
        $this->guardAge($age);

        $this->name    = $name;
        $this->balance = 0;

        $this->email = $email;
        $this->age   = $age;
        $this->type  = $type;
    }

    private function guardName(string $name): void
    {
        if (trim($name) === '') {
            throw new \InvalidArgumentException("name cannot be empty");
        }
    }

    private function guardAge(?int $age): void
    {
        if ($age !== null && $age < 0) {
            throw new \InvalidArgumentException("cannot be empty");
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }
    public function addBalance($amount){
        $this->balance += $amount;
        return $this->balance;
    }

    public function subtractBalance($amount){
        $this->balance -= $amount;
        return $this->balance;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function getType(): ?string
    {
        return $this->type;
    }
}
