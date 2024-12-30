<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'ADMIN';
    case Editor = 'EDITOR';
    case Viewer = 'VIEWER';
}
