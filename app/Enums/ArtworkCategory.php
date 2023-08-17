<?php

namespace App\Enums;

enum ArtworkCategory: string
{
    case PAINTINGS = 'paintings';
    case DRAWINGS = 'drawings';
    case DIGITAL_ART = 'digital arts';
    case SCULPTURES = 'sculptures';
}