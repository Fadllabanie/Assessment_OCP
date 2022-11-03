<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Services\UserService;
use App\Interface\ReadFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function provider_can_add_users_using_json_file()
    {

        $file = public_path() . '/users.json';

        UserService::crateFromJsonFile($file);

        $user =  User::where('email', 'hi@hi.hi')->first();

        $this->assertDatabaseHas('users', [
            'email' => $user->email
        ]);
        $this->assertDatabaseHas('users', [
            'code' => $user->code
        ]);
    }
}
