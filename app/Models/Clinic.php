<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

    protected $table = 'clinics';
    // protected $primaryKey = 'id';
    //public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['name','path'];
    protected $hidden = ['token'];
    // protected $dates = [];
}
