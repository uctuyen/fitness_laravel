<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'quantity_member',
    ];
    protected $table = 'classes';
}