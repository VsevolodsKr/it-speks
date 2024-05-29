<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'company',
        'time',
        'salary',
        'location',
        'description',
        'contacts',
        'image_title',
        'image_path',
    ];
}
