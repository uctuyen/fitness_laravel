<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Calendar extends Model
{
    use HasFactory;
    protected $table = 'calendars';
    protected $fillable = [
        'class_id',
        'start_date',
        'end_date',
    ];

    protected $appends = array('time_calendar');

    public function class()
    {
        return $this->belongsTo(classModel::class, 'class_id');
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'calendar_id');
    }

    public function timeCalendar(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes)
            => 'Ngày: ' . formatDate($attributes['start_date'], 'd-m-Y') . ' | ' . formatDate($attributes['start_date'], 'H:i') . ' - ' . formatDate($attributes['end_date'], 'H:i'),
        );
    }

    // Define relationships and other methods here
}
