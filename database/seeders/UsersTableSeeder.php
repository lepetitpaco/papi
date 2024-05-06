<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'xxxx@xxxx.xxxx')->first();

        if (!$user) {
            $user = User::create([
                'name' => 'xxxx',
                'email' => 'xxxx@xxxx.xxxx',
                'password' => bcrypt('xxxx'), // Initial password
            ]);
        }

        // Update the password if the user exists
        if ($user) {
            $user->password = bcrypt('xxxx');
            $user->save();
        }
    }
}
