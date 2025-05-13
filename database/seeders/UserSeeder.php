<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->create([
                'name' => 'Super Admin ScrumApps',
                'email' => 'tebar.development@gmail.com',
                'password' => bcrypt('tebar!Dev9'),
                'role' => 'Superadmin',
                'phone_number' => '081234567891'
            ]);

        User::factory()
            ->create([
                'name' => 'Tebar Support',
                'email' => 'tebar.support@gmail.com',
                'password' => bcrypt('tebar!Dev9'),
                'role' => 'ProductOwner',
                'phone_number' => '081234567892'
            ]);

        User::factory()
            ->create([
                'name' => 'Clariva',
                'email' => 'clariva@gmail.com',
                'password' => bcrypt('tebar!Dev9'),
                'role' => 'ProductOwner',
                'phone_number' => '081234567893'
            ]);

        User::factory()
            ->create([
                'name' => 'Meydieta',
                'email' => 'meydieta@gmail.com',
                'password' => bcrypt('tebar!Dev9'),
                'role' => 'TeamDeveloper',
                'phone_number' => '081234567894'
            ]);
    }
}
