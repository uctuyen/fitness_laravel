<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    // Các trường trong bảng major
    protected $fillable = [
        'major_name',
        'description',
    ];
    protected $table = 'majors';

    public function trainers()
    {
        return $this->belongsToMany(Trainer::class, 'trainer_major', 'major_id', 'trainer_id');
    }
}