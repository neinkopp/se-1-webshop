<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\Calculator;
use PHPUnit\Framework\Attributes\DataProvider;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    #[DataProvider('calculatorValues')]
    public function test_that_true_is_true(int $first, int $second, int $correctResult): void
    {
        $calculator = new Calculator();

        $this->assertEquals($correctResult, $calculator->add(firstNumber: $first, secondNumber: $second));
    }

    public static function calculatorValues(): array {
        return [
            [1, 10, 11],
            [0, 13, 13],
            [-5, -2, -7],
            [2, -6, -4]
        ];
    }
}
