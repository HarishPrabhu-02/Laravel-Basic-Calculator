<?php

namespace Tests\Feature;

use Tests\TestCase;

class CalculatorTest extends TestCase
{
    public function test_it_can_add_two_numbers(): void
    {
        $response = $this->get('/add/10/5');

        $response->assertStatus(200)
                 ->assertJson([
                     'operation' => 'add',
                     'result' => 15
                 ]);
    }

    public function test_it_can_subtract_two_numbers(): void
    {
        $response = $this->get('/subtract/10/5');

        $response->assertStatus(200)
                 ->assertJson(['result' => 5]);
    }

    public function test_it_can_multiply_two_numbers(): void
    {
        $response = $this->get('/multiply/10/5');

        $response->assertStatus(200)
                 ->assertJson(['result' => 50]);
    }

    public function test_it_can_divide_two_numbers(): void
    {
        $response = $this->get('/divide/10/5');

        $response->assertStatus(200)
                 ->assertJson(['result' => 2]);
    }

    public function test_it_handles_division_by_zero_gracefully(): void
    {
        $response = $this->get('/divide/10/0');

        $response->assertStatus(400)
                 ->assertJson(['error' => 'Division by zero is not allowed.']);
    }

    public function test_it_validates_non_numeric_parameters(): void
    {
        $response = $this->get('/add/10/abc');

        $response->assertStatus(400)
                 ->assertJson(['error' => 'Both parameters must be numeric.']);
    }
}