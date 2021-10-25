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
        $this->call(PermissionSeeder::Class);
        $this->call(ClinicsSeeder::Class);
        $this->call(UsersSeeder::Class);
    }
}
