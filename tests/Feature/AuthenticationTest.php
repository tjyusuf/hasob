<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class AuthenticationTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMustEnterEmailAndPasswordForLogin()
    {
        $this->postJson(route('auth.login'))
            ->assertStatus(422)
            ->assertJson([
                "errors" => [
                    'email' => ["The email field is required."],
                    'password' => ["The password field is required."],
                ]
            ]);
    }

    public function testSuccessfulLogin()
    {
        $password = $this->faker->password;
        $user = User::factory()->create([
           'email' => $this->faker->email,
           'password' => bcrypt($password),
        ]);

        $loginData = ['email' => $user->email, 'password' => $password];
        $response = $this->postJson(route('auth.login'),$loginData)->assertStatus(200);
        $this->assertAuthenticated();
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRequiredFieldsForRegister()
    {
        $response = $this->postJson(route('auth.register'))
            ->assertStatus(422)
            ->assertJson([
                "errors" => [
                    'first_name' => ["The first name field is required."],
                    'last_name' => ["The last name field is required."],
                    'email' => ["The email field is required."],
                    'phone_number' => ["The phone number field is required."],
                    'password' => ["The password field is required."],
                ]
            ]);

    }


    public function testSuccessfulRegistration()
    {
        $user = [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email,
            'phone_number' => $this->faker->phoneNumber(),
            'password' => $this->faker->password()  
        ];

        $response = $this->postJson(route('auth.register'),$user)
                            ->assertStatus(201)
                            ->assertJson([
                                'user' => [
                                    'first_name' => $user['first_name'],
                                    'last_name' => $user['last_name'],
                                    'email' => $user['email'],
                                    'phone_number' => $user['phone_number'],
                                ],
                            ]);
    }

}
