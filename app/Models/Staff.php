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
        'employment_date' => 'datetime',
        'detartment' => Departments::class,
    ];
}
