<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculationController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate the request data
        $validated = $request->validate([
            'x' => 'required|numeric',
            'y' => 'required|numeric',
            'operation' => 'required|in:add,subtract,multiply,divide',
        ]);

        $x = $validated['x'];
        $y = $validated['y'];
        $operation = $validated['operation'];
        $result = 0;

        // 2. Perform the calculation based on the operation type
        switch ($operation) {
            case 'add':
                $result = $x + $y;
                break;
            case 'subtract':
                $result = $x - $y;
                break;
            case 'multiply':
                $result = $x * $y;
                break;
            case 'divide':
                // Prevent division by zero error
                if ($y == 0) {
                    return response()->json(['error' => 'Division by zero is not allowed.'], 422);
                }
                $result = $x / $y;
                break;
        }

        // 3. Save to the database
        $calculation = Calculation::create([
            'x' => $x,
            'y' => $y,
            'operation' => $operation,
            'result' => $result,
        ]);

        return response()->json([
            'message' => 'Calculation saved successfully!',
            'data' => $calculation
        ], 201);
    }
}
