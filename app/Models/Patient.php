<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';
    // protected $primaryKey = 'id';
    //public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['name','dateBirth','phone','address','employment','clinic_id'];
    //protected $hidden = [];
    // protected $dates = [];

    public function medical_records()
    {
        return $this->hasOne(MedicalRecord::class, 'patient_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }
}
