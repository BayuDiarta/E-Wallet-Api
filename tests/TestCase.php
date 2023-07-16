<?php

namespace Tests;
use Faker\Factory;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
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

    public function loginUser()
    {
        // User::create([
        //     'fullname' => 'test',
        //     'email' => 'test@gmail.com',
        //     'password' => Hash::make('Pasww123!34'),
        //     'telphone' => '0894565434322',
        // ]);
        
        $token = auth()->attempt([
            'email' => 'test@gmail.com',
            'password' => 'Pasww123!34'
        ]);
        return ["token" => $token];
    }
}
