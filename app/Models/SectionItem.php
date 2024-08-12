<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'title',
        'animation',
        'bgColor',
        'textColor',
        'colSpan',
        'rowSpan',
        'colStart',
        'rowStart',
        'isCarousel',
        'images',
        'description',
    ];

    protected $casts = [
        'images' => 'array', // Automatically casts JSON column to array
    ];
}
