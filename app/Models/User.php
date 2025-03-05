<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'staff_id',
        'role',
        'phone',
        'address',
        'department',
        'position',
        'photo',
        'birth_date',
        'gender',
        'annual_leave_quota',
        'used_leave'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date'
    ];

    public function getPhotoAttribute()
    {
        return isset($this->attributes['photo']) ? $this->attributes['photo'] : null;
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function getRemainingLeaveAttribute()
    {
        return $this->annual_leave_quota - $this->used_leave;
    }

    public function incrementUsedLeave()
    {
        $this->increment('used_leave');
    }

    public function decrementUsedLeave()
    {
        if ($this->used_leave > 0) {
            $this->decrement('used_leave');
        }
    }
}
