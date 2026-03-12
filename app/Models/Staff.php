<?php

namespace App\Models;

use App\Enums\Departments;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'emergency_contact_details' => 'array',
        'account_details' => 'array',
        'employment_date' => 'date',
        'department' => Departments::class,
        'annual_leave' => 'array',
        'sick_leave' => 'array',
        'work_authorization' => 'array',
        'certifications' => 'array',
        'performance_reviews' => 'array',
        'disciplinary_records' => 'array',
        'training_records' => 'array',
        'promotion_history' => 'array',
        'skills' => 'array',
        'termination_date' => 'date',
    ];

    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . ($this->middlename ?? '') . ' ' . $this->surname;
    }
}
