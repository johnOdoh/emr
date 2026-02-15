<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'dob' => 'datetime',
        'allergies' => 'array',
        'chronic_conditions' => 'array',
        'current_medications' => 'array',
    ];

    public function vitals()
    {
        return $this->hasMany(Vital::class);
    }

    public function labResults()
    {
        return $this->hasMany(LabResult::class);
    }
}
