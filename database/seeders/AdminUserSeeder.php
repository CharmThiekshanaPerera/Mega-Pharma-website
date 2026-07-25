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
        $email = 'admin@megapharma.lk';
        $password = 'MegaPharma@2026';

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Mega Pharma Admin',
                'password' => Hash::make($password),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        $this->command?->warn("Admin user ready — email: {$email} · password: {$password} (change this after first login).");
    }
}
