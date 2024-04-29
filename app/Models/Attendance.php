<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'class_id',
        'date_attendance',
        'time'
    ];
    protected $table = 'attendances';

    public function member (){
        return $this->belongsTo(Member::class);
    }
    public function class (){
        return $this->belongsTo(classModel::class);
    }
}
