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
        $response = $this->postJson('/api/person', [
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

    public function test_can_create_person_over_18(): void
    {
        $response = $this->postJson('/api/person', [
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

    public function test_can_list_people(): void
    {
        $response = $this->getJson('/api/person');
        $response->assertStatus(200);
    }

    public function test_can_update_person(): void
    {
        $person = \App\Models\Person::factory()->create();

        $response = $this->putJson("/api/person/{$person->id}", [
            'name' => 'João Atualizado',
            'email' => 'joao.atualizado@teste.com',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('people', ['name' => 'João Atualizado']);
    }

    public function test_can_delete_person(): void
    {
        $person = \App\Models\Person::factory()->create();

        $response = $this->deleteJson("/api/person/{$person->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('people', ['id' => $person->id]);
    }

    public function test_cannot_update_person_with_existing_email(): void
    {
        $person1 = \App\Models\Person::factory()->create(['email' => 'outro@teste.com']);
        $person2 = \App\Models\Person::factory()->create();

        $response = $this->putJson("/api/person/{$person2->id}", [
            'name' => 'Pessoa 2',
            'email' => 'outro@teste.com',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors(['email']);
    }

}