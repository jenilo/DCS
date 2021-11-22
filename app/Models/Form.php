<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $table = 'forms';
    // protected $primaryKey = 'id';
    //public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['name','clinic_id'];
    //protected $hidden = [];
    // protected $dates = [];

    public function questions(){
        return $this->hasMany(Question::class,'form_id');
    }
}
