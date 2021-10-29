<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'answer_types';
    // protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['date','timeStart','timeEnd','notes','patient_id','treatment_id'];
    //protected $hidden = [];
    // protected $dates = [];

    public function treatment()
    {
        return $this->belongsTo(Treatment::class, 'treatment_id');
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class, 'treatment_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function patients()
    {
        return $this->hasMany(Patient::class, 'patient_id');
    }

}
