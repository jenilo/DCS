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
        $answertype = new AnswerType();
        $answertype->answerType = "Si o No";
        $answertype->save();

        $answertype = new AnswerType();
        $answertype->answerType = "Pregunta abierta";
        $answertype->save();
    }
}
