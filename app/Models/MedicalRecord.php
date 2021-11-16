<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $table = 'medical_records';
    // protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['dateAdmission','observations','patient_id'];
    //protected $hidden = [];
    // protected $dates = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'medical_record_id');
    }

    public function forms_completed()
    {
        return $this->hasMany(CompletedForm::class, 'medical_record_id');
    }
}
