<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Test Account',
            'email' => 'test.account@example.com',
            'password' => Hash::make('t3st4cc0unt'),
        ]);
        User::factory(10)->create();
    }
}
