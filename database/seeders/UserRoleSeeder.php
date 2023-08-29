<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'authorized',
            'normal'
        ];

        foreach ($roles as $role) {
            if (!$this->getExistingData($role)) {
                UserRole::create([
                    'name' => $role
                ]);
            }
        }
    }

    private function getExistingData($name): ?Model
    {
        return UserRole::where('name', $name)->first();
    }
}
