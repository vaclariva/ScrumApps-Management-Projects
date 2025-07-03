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
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('scrumapps123'),
                'role' => 'Superadmin',
                'phone_number' => '081234567891'
            ]);

        User::factory()
            ->create([
                'name' => 'Support',
                'email' => 'support@gmail.com',
                'password' => bcrypt('scrumapps123'),
                'role' => 'ProductOwner',
                'phone_number' => '081234567892'
            ]);

        User::factory()
            ->create([
                'name' => 'Clariva PO',
                'email' => 'vaclariva@gmail.com',
                'password' => bcrypt('scrumapps123'),
                'role' => 'ProductOwner',
                'phone_number' => '081234567893'
            ]);

        User::factory()
            ->create([
                'name' => 'Meydieta DT',
                'email' => 'meyclariva@gmail.com',
                'password' => bcrypt('scrumapps123'),
                'role' => 'TeamDeveloper',
                'phone_number' => '081234567894'
            ]);
    }
}
