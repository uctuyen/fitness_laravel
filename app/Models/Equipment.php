<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'status',
        'quantity',
        'room_id'
    ];
    protected $table = 'equipments';

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
