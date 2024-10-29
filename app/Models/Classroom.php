<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'teacher_name',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function classCategory()
    {
        return $this->belongsTo(ClassCategory::class, 'category_id');
    }
}
