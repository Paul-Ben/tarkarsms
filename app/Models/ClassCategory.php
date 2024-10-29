<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'abbreviation',
    ];

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}
