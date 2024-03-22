<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiContactTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreMethod()
    {
        $requestData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'birth' => '1990-01-01',
            'cpf' => '85676901020',
            'phones' => [
                ['phone' => '123456789', 'ddd' => '11', 'type' => 'Residencial'],
                ['phone' => '987654321', 'ddd' => '11', 'type' => 'Celular'],
            ],
        ];

        $response = $this->json('POST', '/api/contacts', $requestData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'email',
                'birth',
                'cpf',
                'phones' => [
                    '*' => [
                        'id',
                        'contact_id',
                        'phone',
                        'ddd',
                        'type',
                        'created_at',
                        'updated_at',
                    ]
                ],
                'created_at',
                'updated_at',
            ]);

        $this->assertDatabaseHas('contacts', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'birth' => '1990-01-01',
            'cpf' => '85676901020',
        ]);

        $contact = Contact::where('email', 'john@example.com')->first();
        $this->assertNotNull($contact);

        foreach ($requestData['phones'] as $phoneData) {
            $this->assertDatabaseHas('phones', [
                'contact_id' => $contact->id,
                'phone' => $phoneData['phone'],
                'ddd' => $phoneData['ddd'],
                'type' => $phoneData['type'],
            ]);
        }
    }
}
