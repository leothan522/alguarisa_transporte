<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => config('app.root_user'),
            'email' => config('app.root_email'),
            'password' => Hash::make(config('app.rootpassword'))
        ]);

        if (!User::where('email', 'admin@alguarisa.com')->exists()){
            $user = User::factory()->create([
                'name' => 'Administrador',
                'email' => "admin@alguarisa.com",
                'password' => Hash::make('admin1234')
            ]);
        }

        $user->assignRole('admin');
    }
}
