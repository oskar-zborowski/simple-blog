<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class GiveRoleToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::get();

        /** @var User $user */
        foreach ($users as $user) {
            $user->assignRole(rand(1, 3));
        }
    }
}
