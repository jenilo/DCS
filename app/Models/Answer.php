<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answers';
    // protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['answer','question_id','medical_record_id'];
    //protected $hidden = [];
    // protected $dates = [];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
