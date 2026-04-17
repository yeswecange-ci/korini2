<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'name'     => 'Admin Korini',
                'email'    => 'admin@korini.com',
                'password' => env('ADMIN_PASSWORD', 'korini2025'),
            ],
        ];

        foreach ($admins as $admin) {
            $user = User::where('email', $admin['email'])->first();

            if ($user) {
                $user->update(['password' => Hash::make($admin['password'])]);
                $this->command->info("Mis à jour : {$admin['email']}");
            } else {
                $u = new User();
                $u->name     = $admin['name'];
                $u->email    = $admin['email'];
                $u->password = Hash::make($admin['password']);
                $u->save();
                $this->command->info("Créé : {$admin['email']}");
            }
        }
    }
}
