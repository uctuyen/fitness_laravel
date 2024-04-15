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

    public function trainers()
    {
        return $this->belongsToMany(Trainer::class, 'trainer_majors', 'major_id', 'trainer_id');
    }
}