<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'location',
        'about_me',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function monthlyReports()
    {
        return $this->hasMany(MontlyReport::class);
    }


    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }


    // public function hasRole($role)
    // {
    //     return $this->role === $role;
    // }

    public function hasRole($role)
    {
        return $this->roles->contains('name', $role);
    }


    public function dailyReports()
    {
        return $this->hasMany(DailyReport::class, 'user_id');
    }

    // public function interns()
    // {
    //     return $this->hasMany(User::class, 'supervisor_id', 'id')->where('role', 'magang');
    // }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id');
    }

    public function interns()
    {
        return $this->hasMany(User::class, 'supervisor_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id', 'id');
    }


    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'user_id');
    }


}
