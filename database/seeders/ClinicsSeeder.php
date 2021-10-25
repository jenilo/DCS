<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Clinic;


class ClinicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clinic = new Clinic();
        $clinic->name = "Clínica La Conchita";
        //$clinic->token = Hash::make(Str::random(48));
        $clinic->token = "2y10tzvy8Qa/w7.nwKSzh4/6r.XtdArHBClAmDOAEEw7GXDZqVnpY4o4.";
        //$clinic->path = Str::slug($clinic->name);
        $clinic->path = Str::slug(Str::replace(' ', '', $clinic->name));
        $clinic->save();
    }
}
