<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class CalculationController extends Controller
{
    public function add($x, $y): JsonResponse
    {
        return $this->processCalculation('add', $x, $y, fn($a, $b) => $a + $b);
    }

    public function subtract($x, $y): JsonResponse
    {
        return $this->processCalculation('subtract', $x, $y, fn($a, $b) => $a - $b);
    }

    public function multiply($x, $y): JsonResponse
    {
        return $this->processCalculation('multiply', $x, $y, fn($a, $b) => $a * $b);
    }

    public function divide($x, $y): JsonResponse
    {
        if (is_numeric($y) && $y == 0) {
            return response()->json(['error' => 'Division by zero is not allowed.'], 400);
        }
        
        return $this->processCalculation('divide', $x, $y, fn($a, $b) => $a / $b);
    }

    // Validates inputs, executes the math logic, and formats the JSON response.
    private function processCalculation(string $operation, $x, $y, callable $mathLogic): JsonResponse
    {
        //Check if the two inputs are of numeric type
        if (!is_numeric($x) || !is_numeric($y)) {
            return response()->json(['error' => 'Both parameters must be numeric.'], 400);
        }

        //Returns the results as a JSON response

        return response()->json([
            'operation' => $operation,
            'operands' => [
                'x' => (float) $x,
                'y' => (float) $y
            ],
            'result' => $mathLogic((float) $x, (float) $y)
        ]);
    }
}