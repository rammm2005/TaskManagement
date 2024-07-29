<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\Intern as Authenticatable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Intern extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'interns';
    protected $primaryKey = 'intern_id';
    public $timestamps = true;

    protected $hidden = [
        'password',
    ];


    // Relasi dengan tabel lain
    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function dailyReports()
    {
        return $this->hasMany(DailyReport::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
