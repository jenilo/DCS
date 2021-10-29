<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $table = 'answer_types';
    // protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['name'];
    //protected $hidden = [];
    // protected $dates = [];
}
