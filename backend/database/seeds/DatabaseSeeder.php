<?php

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
        $this->call(PaymentMethodsDefaultSeeder::class);
        $this->call(StatusesDefaultSeeder::class);
        $this->call(CountriesSeeder::class);

        $this->call(PermissionTableSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UsersDefaultSeeder::class);    }
}
