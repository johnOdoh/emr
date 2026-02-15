<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'Admin';
    case NURSE = 'Nurse';
    case DOCTOR = 'Doctor';
    case HR = 'HR';

    public static function toArray(): array
    {
        return array_map(fn(self $role) => $role->value, self::cases());
    }
}
