<?php

namespace Database\Seeders;

use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'admin',
        ]);

        $bank= Role::create([
            'name' => 'bank',
        ]);

        $canteen = Role::create([
            'name' => 'canteen',
        ]);

        $user = Role::create([
            'name' => 'user',
        ]);

        $admin_account = User::create([
            "name" => "Admin",
            "email" => "admin@test.com",
            "password" => Hash::make("admin"),
            "role_id" => $admin->id,
        ]);

        $bank_account = User::create([
            "name" => "Bank",
            "email" => "bank@test.com",
            "password" => Hash::make("bank"),
            "role_id" => $bank->id,
        ]);

        $canteen_account = User::create([
            "name" => "Canteen",
            "email" => "canteen@test.com",
            "password" => Hash::make("canteen"),
            "role_id" => $canteen->id,
        ]);

        $user_account = User::create([
            "name" => "User",
            "email" => "user@test.com",
            "password" => Hash::make("user"),
            "role_id" => $user->id,
        ]);

        Wallet::create([
            'user_id' => $user_account->id,
            'wallet_address' => mt_rand(100000000000, 999999999999),
            'balance' => 0,
        ]);
    }
}
