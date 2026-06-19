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
    $response->assertJsonStructure(['message']);
    $response->assertJson(['message' => 'OTP sent successfully, please check your email']);
});

test('user cant login using wrong email', function () {
    $response = $this->post('/api/login', [
        'username' => 'test@gmail.com'
    ]);

    $response->assertStatus(422);
    $response->assertJsonStructure(['message']);
    $response->assertJson(['message' => 'User not found with provided email or phone. Please check your credentials.']);
});

test('user can login using phone', function () {
    $user = User::factory()->create();

    $response = $this->post('/api/login', [
        'username' => $user->phone
    ]);

    $response->assertStatus(200);
    $response->assertJsonStructure(['message']);
    $response->assertJson(['message' => 'OTP sent successfully, please check your email']);
});

test('user cant login using wrong phone', function () {
    $response = $this->post('/api/login', [
        'username' => '+201236548954'
    ]);

    $response->assertStatus(422);
    $response->assertJsonStructure(['message']);
    $response->assertJson(['message' => 'User not found with provided email or phone. Please check your credentials.']);
});
