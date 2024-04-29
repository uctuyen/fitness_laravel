<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
class Trainer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = 'trainer';
    protected $fillable = [
        'avatar',
        'first_name',
        'last_name',
        'gender',
        'day_of_birth',
        'phone_number',
        'email',
        'password',
        'province_id',
        'district_id',
        'ward_id',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $table = 'trainers';

    public function majors()
    {
        return $this->belongsToMany(Major::class, 'trainer_majors', 'trainer_id', 'major_id');
    }
    public function class()
    {
        return $this->hasMany(classModel::class, 'trainer_id');
    }
}
