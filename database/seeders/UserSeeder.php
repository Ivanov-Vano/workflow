<?php

namespace Database\Seeders;

use App\Models\Accesses\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'email' => 'chief@mail.ru',
            'email_verified_at' => now(),
            'password' => '$2y$10$R5vBPe6dfxDQevMtpH6pmetk3B0oyACoFU7RvLkz8EhUE4u99.r.O', // password 12345678
            'remember_token' => Str::random(10),
            'username' => 'admin',
            'name' => 'admin',
        ]);
        $role = Role::create([
            'name' => 'Суперпользователь',
        ]);
        $user->AssignRole($role);
    }
}
