<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

uses(RefreshDatabase::class);

test('user can register', function () {
    $response = $this->post('/api/register', [
        'name'           => 'John Doe',
        'email'          => 'john8@gmail.com',
        'phone'          => '+20123654789',
        'user_type'      => 'owner',
        'market_name'    => 'My Market',
        'market_name_ar' => 'متجرى',
        'cr_number'      => '101012345',
    ]);

    $response->assertStatus(201);
    $response->assertJsonStructure(['message']);
    $response->assertJson(['message' => 'User registered successfully']);
});
