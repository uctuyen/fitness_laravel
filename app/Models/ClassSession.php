<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSession extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
    ];
    protected $table = 'class_sessions';
}
