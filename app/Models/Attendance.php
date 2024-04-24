<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'calendar_id',
    ];
    protected $table = 'attendance';

    public function member (){
        return $this->belongsTo(Member::class);
    }
    public function calendar (){
        return $this->belongsTo(Calendar::class);
    }
}
