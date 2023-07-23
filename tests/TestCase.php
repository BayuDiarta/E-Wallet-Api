<?php

namespace Tests;
use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use DatabaseMigrations, DatabaseTransactions;
    protected $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
    }
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function login()
    {
        // Check if the user already exists
        $user = User::where('email', 'test@gmail.com')->first();

        if (!$user) {
            // Create the test user
            $user = User::create([
                'fullname' => 'John Doe',
                'email' => 'test@gmail.com',
                'password' => Hash::make('Pasww123!34'),
                'telphone' => '08947464385',
            ]);
        }

        // Attempt to authenticate the user and get the token
        $token = auth()->attempt([
            'email' => 'test@gmail.com',
            'password' => 'Pasww123!34',
        ]);

        return ["token" => $token];
    }
}
