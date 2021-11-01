<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\AnswerType;
use App\Models\Question;
use App\Models\Form;
use Auth;

class QuestionController extends Controller
{
    public function index(Form $form){
        $answertypes = AnswerType::all();
        return view('forms.create',compact('form','answertypes'));
    }
    public function store(){

    }
}
