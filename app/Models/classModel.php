<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'trainer_id',
        'major_id',
        'price',
        'quantity_member',
    ];
    protected $table = 'classes';

    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'trainer_id');
    }
    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }
    public function calendar()
    {
        return $this->hasMany(Calendar::class, 'class_id');
    }
    public function room()
    {
        return $this->hasOne(Room::class, 'class_id');
    }
    public function attendance(){
        return $this->hasMany(Attendance::class);
}
}
