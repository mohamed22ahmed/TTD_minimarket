<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

uses(RefreshDatabase::class);

test('user can login using email', function () {
    $user = User::factory()->create();

    $response = $this->post('/api/login', [
        'username' => $user->email
    ]);

    $response->assertStatus(200);
    $response->assertJsonStructure(['message', 'otp']);
    $response->assertJson(['message' => 'OTP sent successfully']);
    $response->assertJson(['otp' => $response->json()['otp']]);
});
