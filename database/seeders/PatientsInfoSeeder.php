<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Illuminate\Treatment;

class PatientsInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patient = new Patient();
        $patient->name = "Jennifer Lopez";
        $patient->dateBirth = "1999-09-10";
        $patient->phone = "6241101607";
        $patient->address = "Lomas del sol mza. 92 lte. 12";
        $patient->employment = "Estudiante";
        $patient->clinic_id = 1;
        $patient->save();

        $medicalRecord = new MedicalRecord();
        $medicalRecord->dateAdmission = "2021-09-11";
        $medicalRecord->observations = "Sin observaciones.";
        $medicalRecord->patient_id = 1;
        $medicalRecord->save();

        $patient = new Patient();
        $patient->name = "Mariana Lopez";
        $patient->dateBirth = "2005-09-02";
        $patient->phone = "6241750249";
        $patient->address = "Lomas del sol mza. 92 lte. 12";
        $patient->employment = "Estudiante";
        $patient->clinic_id = 1;
        $patient->save();

        $medicalRecord = new MedicalRecord();
        $medicalRecord->dateAdmission = "2021-09-11";
        $medicalRecord->observations = "Sin observaciones.";
        $medicalRecord->patient_id = 2;
        $medicalRecord->save();

        $patient = new Patient();
        $patient->name = "Juan Marquez";
        $patient->dateBirth = "2001-05-10";
        $patient->phone = "6240000000";
        $patient->address = "Sin dirección";
        $patient->employment = "Estudiante";
        $patient->clinic_id = 1;
        $patient->save();

        $medicalRecord = new MedicalRecord();
        $medicalRecord->dateAdmission = "2021-09-11";
        $medicalRecord->observations = "Sin observaciones.";
        $medicalRecord->patient_id = 3;
        $medicalRecord->save();

        $patient = new Patient();
        $patient->name = "Abigail Lopez";
        $patient->dateBirth = "1993-12-03";
        $patient->phone = "6240000000";
        $patient->address = "Sin dirección";
        $patient->employment = "Ama de casa";
        $patient->clinic_id = 1;
        $patient->save();

        $medicalRecord = new MedicalRecord();
        $medicalRecord->dateAdmission = "2021-09-11";
        $medicalRecord->observations = "Sin observaciones.";
        $medicalRecord->patient_id = 4;
        $medicalRecord->save();

    }
}
