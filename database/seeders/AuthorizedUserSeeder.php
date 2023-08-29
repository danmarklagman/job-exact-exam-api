<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AuthorizedUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!$this->getExistingUserData('dan')) {
            $role = UserRole::where('name', 'authorized')->first();
            User::create([
                'user_role_id'  => $role->id,
                'username'      => 'dan',
                'email'         => 'dan@test.com',
                'password'      => bcrypt('P@ssword123'),
                'name'          => 'Dan Mark Lagman',
                'phone'         => '+639175121901',
                'website'       => 'http://www.iskripted.com'
            ]);
        }
    }

    private function getExistingUserData($username): ?Model
    {
        return User::where('username', $username)->first();
    }
}
