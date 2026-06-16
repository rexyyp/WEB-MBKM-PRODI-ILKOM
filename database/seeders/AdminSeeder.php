<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin default — gunakan untuk login pertama kali
        User::updateOrCreate(
            ['email' => 'admin@mbkm.ac.id'],
            [
                'name'      => 'Administrator',
                'email'     => 'admin@mbkm.ac.id',
                'password'  => Hash::make('admin123'),
                'role'      => 'admin',
                'is_active' => true,
            ]
        );

        $this->command->info('✅ Admin default berhasil dibuat:');
        $this->command->info('   Email    : admin@mbkm.ac.id');
        $this->command->info('   Password : admin123');
    }
}
