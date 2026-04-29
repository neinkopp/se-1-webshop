<?php

namespace App\Services;

class Calculator
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Invoke the class instance.
     */
    public function __invoke(): void
    {
        //
    }

    public function add(int $firstNumber = 1, int $secondNumber = 2): int {
        return $firstNumber + $secondNumber;
    }
}
