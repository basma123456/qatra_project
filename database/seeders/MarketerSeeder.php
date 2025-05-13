<?php

namespace Database\Seeders;

use App\Models\Marketer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MarketerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marketer::create([
            'name' => 'John Doe',
            'mobile' => '1234567890',
            'email' => 'marketer@gmail.com',
            'password' => Hash::make('12345678'),
            'marketer_admin_id' => 1,
            'browse_code' => 'ABC123XYZ',
            'affiliate_code' => 'AFF123XYZ',
            'email_verified_at' => now(),
            'remember_token' => null,
        ]);

        Marketer::create([
            'name' => 'Jane Smith',
            'mobile' => '9876543210',
            'email' => 'marketer2@gmail.com',
            'marketer_admin_id' => 1,
            'password' => Hash::make('12345678'),
            'browse_code' => 'XYZ456ABC',
            'affiliate_code' => 'AFF456XYZ',
            'email_verified_at' => now(),
            'remember_token' => null,
        ]);

    }
}
