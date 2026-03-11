<?php

namespace App\Enums;

enum Departments: string
{
    case FRONT_DESK = 'Front Desk';
    case NURSE = 'Nurse';
    case HOSPITAL_LIAISON = 'Hospital Liaison';
    case HR = 'HR';

    public static function toArray(): array
    {
        return array_map(fn(self $role) => $role->value, self::cases());
    }

    public static function toOptions(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn(self $dept) => [$dept->value => $dept->value])
            ->toArray();
    }
}
