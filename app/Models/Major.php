<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Major extends Model
{
    use  HasFactory;
    protected $fillable = [
        'major_name',
        'description',
    ];
    protected $table = 'majors';

    public function major()
    {
        return $this->belongsToMany(Major::class, 'trainer_major', 'trainer_id', 'major_id');
    }
}