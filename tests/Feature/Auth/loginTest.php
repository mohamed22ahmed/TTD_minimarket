<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

uses(RefreshDatabase::class);

test('user can login using email', function () {
    $user = User::factory()->create([
        'email' => 'memo@gmail.com',
    ]);

    $response = $this->post('/api/en/login', [
        'username' => $user->email
    ]);

    $response->assertStatus(200);
});
