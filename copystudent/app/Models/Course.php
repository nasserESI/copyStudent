<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Course extends Model
{
    use HasFactory;
    protected $attributes = [
        'course',
        'student',
        'teacher',
    ];
    protected $fillable = [
        'course',
        'student',
        'teacher',
        ];
    protected $primaryKey = 'id';
    public function copy():BelongsToMany
    {
        return $this->belongsToMany(Copy::class,'id');
    }
    public function teacher():HasOne
    {
        return $this->hasOne(User::class,'id');
    }
}
