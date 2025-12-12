<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin321'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('cirebon321'),
                'role' =>'Admin',
            ]
        );
    }
}
