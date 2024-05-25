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
        'status',
    ];

    protected $table = 'attendances';

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }

    public function getStatus()
    {
        if ($this->status == -1) {
            return 'Đã huỷ';
        }
        if ($this->status == 0) {
            return 'Đã đăng ký';
        }
        if ($this->status == 1) {
            return 'Đã điểm danh';
        }
    }
}
