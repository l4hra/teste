<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PersonBusinessRuleTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;
    public function test_cannot_create_person_under_18(): void
    {
        $response = $this->postJson('/api/people', [
            'name' => 'João Menor',
            'cpf' => '12345678901',
            'birth_date' => now()->subYears(17)->format('Y-m-d'),
            'email' => 'joao@teste.com',
            'phone' => '11999999999',
            'street' => 'Rua X',
            'city' => 'Vila Velha',
            'state' => 'ES',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors(['birth_date']);
    }

    public function test_can_create_person_under_18()
    {
        $response = $this->postJson('/api/people', [
            'name' => 'Maria Maior',
            'cpf' => '10987654321',
            'birth_date' => now()->subYears(20)->format('Y-m-d'),
            'email' => 'maria@teste.com',
            'phone' => '11888888888',
            'street' => 'Rua Y',
            'city' => 'Cariacica',
            'state' => 'ES',
        ]);
        $response->assertStatus(201);
    }
}
