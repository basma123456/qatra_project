<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CategorySeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(PaymentTypeSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(DeliveryTypes::class);
        $this->call(ProductSeeder::class);
        $this->call(PermessionSeeder::class);
        $this->call(MosqueSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(RoleAndPermissionSeeder::class);
    }
}
