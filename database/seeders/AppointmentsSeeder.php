<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        $date = $date->toDateString();

        $appointment = new Appointment();
        $appointment->date = "2021-11-13";
        $appointment->timeStart = "10:00";
        $appointment->timeEnd = "10:30";
        $appointment->notes = "No hay observaciones";
        $appointment->patient_id = 1;
        $appointment->treatment_id = 1;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->date = "2021-11-13";
        $appointment->timeStart = "10:30";
        $appointment->timeEnd = "11:30";
        $appointment->notes = "No hay observaciones";
        $appointment->patient_id = 2;
        $appointment->treatment_id = 1;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->date = "2021-11-14";
        $appointment->timeStart = "10:00";
        $appointment->timeEnd = "10:30";
        $appointment->notes = "No hay observaciones";
        $appointment->patient_id = 1;
        $appointment->treatment_id = 1;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->date = "2021-11-14";
        $appointment->timeStart = "10:30";
        $appointment->timeEnd = "11:30";
        $appointment->notes = "No hay observaciones";
        $appointment->patient_id = 2;
        $appointment->treatment_id = 1;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->date = $date;
        $appointment->timeStart = "10:00";
        $appointment->timeEnd = "10:30";
        $appointment->notes = "No hay observaciones";
        $appointment->patient_id = 1;
        $appointment->treatment_id = 1;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->date = $date;
        $appointment->timeStart = "10:30";
        $appointment->timeEnd = "11:30";
        $appointment->notes = "No hay observaciones";
        $appointment->patient_id = 2;
        $appointment->treatment_id = 1;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->date = "2021-11-16";
        $appointment->timeStart = "10:00";
        $appointment->timeEnd = "10:30";
        $appointment->notes = "No hay observaciones";
        $appointment->patient_id = 1;
        $appointment->treatment_id = 1;
        $appointment->save();

        $appointment = new Appointment();
        $appointment->date = "2021-11-16";
        $appointment->timeStart = "10:30";
        $appointment->timeEnd = "11:30";
        $appointment->notes = "No hay observaciones";
        $appointment->patient_id = 2;
        $appointment->treatment_id = 1;
        $appointment->save();
    }
}
