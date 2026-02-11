<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case NURSE = 'nurse';
    case DOCTOR = 'doctor';
    case HR = 'hr';

    public static function toArray(): array
    {
        return array_map(fn (self $role) => $role->value, self::cases());
    }
}