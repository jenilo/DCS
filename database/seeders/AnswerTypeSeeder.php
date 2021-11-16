<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AnswerType;

class AnswerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $answerType = new AnswerType();
        $answerType->answerType = "Si o No";
        $answerType->save();

        $answerType = new AnswerType();
        $answerType->answerType = "Respuesta abierta corta";
        $answerType->save();
        
        $answerType = new AnswerType();
        $answerType->answerType = "Respuesta abierta larga";
        $answerType->save();
    }
}
