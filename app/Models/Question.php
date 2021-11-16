<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    // protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['question','answer_type_id','form_id'];
    //protected $hidden = [];
    // protected $dates = [];

    public function answerType(){
        return $this->belongsTo(AnswerType::class,'answer_type_id');
    }
}
