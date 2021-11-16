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
        $this->call(ClinicsSeeder::Class);
        $this->call(UsersSeeder::Class);
        $this->call(PermissionSeeder::Class);
        $this->call(PatientsInfoSeeder::Class);
        $this->call(TreatmentSeeder::Class);
        $this->call(AnswerTypeSeeder::Class);
        $this->call(FormSeeder::Class);

        $this->call(AppointmentsSeeder::Class);
    }
}
