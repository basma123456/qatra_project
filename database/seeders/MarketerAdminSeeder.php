<?php

namespace Database\Seeders;

use App\Models\MarketerAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MarketerAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        MarketerAdmin::create([
            'name' => 'Admin John',
            'mobile' => '1234567890',
            'email' => 'marketer_admin@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => 1,
            'email_verified_at' => now(),
            'remember_token' => null,
        ]);

        MarketerAdmin::create([
            'name' => 'Admin Jane',
            'mobile' => '9876543210',
            'email' => 'marketer_admin2@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => 1,
            'email_verified_at' => now(),
            'remember_token' => null,
        ]);

    }
}
