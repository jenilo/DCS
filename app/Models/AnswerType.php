<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerType extends Model
{
    use HasFactory;

    protected $table = 'answer_types';
    // protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['answerType'];
    //protected $hidden = [];
    // protected $dates = [];
}
