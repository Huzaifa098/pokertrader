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
        User::factory()
            ->create([
                'email' => 'admin@email.com',
                'is_admin' => true,
                'bank_name' => null,
                'bank_number' => null,
            ]);

        User::factory(25)
            ->create();
    }
}
