<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Calendar extends Model
{
    use HasFactory;
    protected $table = 'calendars';
    protected $fillable = [
        'class_id',
        'start_date',
        'end_date',
    ];
    public function class()
    {
        return $this->belongsTo(classModel::class, 'class_id');
    }
    public function attendance(){
            return $this->hasMany(Attendance::class);
    }
    // Define relationships and other methods here
}