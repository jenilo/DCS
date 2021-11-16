<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Form;
use App\Models\AnswerType;
use App\Models\Question;
use App\Enums\ResponseType;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $form = new Form();
        $form->name = "Cuestionario de evaluación";
        $form->clinic_id = 1;
        $form->save();

        $question = new Question();
        $question->question = "¿Está o estuvo en los últimos 12 meses bajo tratamiento médico?";
        $question->answer_type_id = ResponseType::YesOrNo;
        $question->form_id = 1;
        $question->save();

        $question = new Question();
        $question->question = "¿Es alérgico a algún tratamiento?";
        $question->answer_type_id = ResponseType::YesOrNo;
        $question->form_id = 1;
        $question->save();

        $question = new Question();
        $question->question = "¿Ha tenico alguna reacción desfavorable a la anestesia local?";
        $question->answer_type_id = ResponseType::YesOrNo;
        $question->form_id = 1;
        $question->save();

        $question = new Question();
        $question->question = "¿Padece o padeció algún transtorno cardiaco?";
        $question->answer_type_id = ResponseType::YesOrNo;
        $question->form_id = 1;
        $question->save();

        $question = new Question();
        $question->question = "¿Esta bajo tratamiento?";
        $question->answer_type_id = ResponseType::ShortOpenQuestion;
        $question->form_id = 1;
        $question->save();
    }
}
