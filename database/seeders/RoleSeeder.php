<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
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

        $bank = Role::create([
            'name' => 'bank',
        ]);

        $canteen = Role::create([
            'name' => 'canteen',
        ]);

        $user = Role::create([
            'name' => 'user',
        ]);
    }
}
