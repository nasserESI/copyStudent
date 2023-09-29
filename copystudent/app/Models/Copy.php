<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copy extends Model
{
    use HasFactory;
    protected $attributes = [

    ];
    protected $fillable = [
        'student',
        'teacher',
        'course',
        'mark',
        'graded',
        'fileName',
    ];
    protected $primaryKey = 'id';
}
