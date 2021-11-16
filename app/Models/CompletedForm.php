<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedForm extends Model
{
    use HasFactory;

    protected $table = 'completed_forms';
    // protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['saveDate','medical_record_id','form_id'];
    //protected $hidden = [];
    // protected $dates = [];

    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'completed_form_id');
    }

    public function medical_record()
    {
        return $this->belongsTo(MedicalRecord::class, 'medical_record_id');
    }


}
