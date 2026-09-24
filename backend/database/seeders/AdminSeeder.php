<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed the default admin account.
     *
     * Credentials are read from the environment so a production deploy can
     * override them, but fall back to a clearly-labelled default for local
     * setup. Change the password after first login via the Security screen.
     */
    public function run(): void
    {
        $email = env('ADMIN_DEFAULT_EMAIL', 'admin@limparglobal.org');
        $password = env('ADMIN_DEFAULT_PASSWORD', 'LimparAdmin#2026');

        Admin::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Limpar Admin',
                'password' => Hash::make($password),
            ]
        );
    }
}
