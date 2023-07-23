<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Database\Factories\UserFactory;
use Database\Factories\WalletFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserFactory::new()->count(1)->create();
        WalletFactory::new()->count(1)->create();
    }
}
