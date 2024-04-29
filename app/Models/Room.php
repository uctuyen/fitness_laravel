<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'class_id',
    ];
    protected $table = 'rooms';

    public function class()
    {
        return $this->belongsTo(classModel::class, 'class_id');
    }
    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }
}
