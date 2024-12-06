<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'adit.admin@gmail.com',
            'password' => bcrypt('midgard1515')
        ]);
        $admin->assignRole('Administrator');

        $admin = User::create([
            'name' => 'direktur',
            'email' => 'adit.direktur@gmail.com',
            'password' => bcrypt('midgard1515')
        ]);
        $admin->assignRole('Project-director');

        $admin = User::create([
            'name' => 'teamleader',
            'email' => 'adit.leader@gmail.com',
            'password' => bcrypt('midgard1515')
        ]);
        $admin->assignRole('Project-leader');

        $admin = User::create([
            'name' => 'staff',
            'email' => 'adit.staff@gmail.com',
            'password' => bcrypt('midgard1515')
        ]);
        $admin->assignRole('Staff');
    }
}
