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
}
