<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'std_number',
        'email',
        'date_of_birth',
        'image',
        'nationality',
        'stateoforigin',
        'lga',
        'genotype',
        'bgroup',
        'guardian_name',
        'guardian_phone',
        'guardian_email',
        'address',
        'class_id'
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id', 'id');
    }
}
