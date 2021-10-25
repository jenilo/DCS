<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeFile extends Model
{
    use HasFactory;

    protected $table = 'type_files';
    // protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['typeFile'];
    //protected $hidden = [];
    // protected $dates = [];
}
