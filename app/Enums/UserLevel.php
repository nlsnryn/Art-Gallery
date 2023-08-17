<?php

namespace App\Enums;

enum UserLevel: string
{
    case ADMIN = 'admin';
    case SUPERADMIN = 'super admin';
    case ARTIST = 'artist';
}