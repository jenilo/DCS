<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Treatment;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $treatment = new Treatment();
        $treatment->name = "Diagnóstico y Prevención";
        $treatment->clinic_id = 1;
        $treatment->save();

        $treatment = new Treatment();
        $treatment->name = "Ortodoncia";
        $treatment->clinic_id = 1;
        $treatment->save();

        $treatment = new Treatment();
        $treatment->name = "Implantes";
        $treatment->clinic_id = 1;
        $treatment->save();

        $treatment = new Treatment();
        $treatment->name = "Odontopediatría";
        $treatment->clinic_id = 1;
        $treatment->save();

        $treatment = new Treatment();
        $treatment->name = "Estética Dental";
        $treatment->clinic_id = 1;
        $treatment->save();

        $treatment = new Treatment();
        $treatment->name = "Periodoncia";
        $treatment->clinic_id = 1;
        $treatment->save();

        $treatment = new Treatment();
        $treatment->name = "Prótesis";
        $treatment->clinic_id = 1;
        $treatment->save();

        $treatment = new Treatment();
        $treatment->name = "Caries";
        $treatment->clinic_id = 1;
        $treatment->save();

        $treatment = new Treatment();
        $treatment->name = "Bruxismo";
        $treatment->clinic_id = 1;
        $treatment->save();


    }
}
