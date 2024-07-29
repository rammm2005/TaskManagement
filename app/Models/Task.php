<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'task_description',
        'duedate',
        'supervisor_id',
        'user_id',
        'completed',
    ];

    // public function intern()
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id')->where('role', 'magang');
    // }

    // public function supervisor()
    // {
    //     return $this->belongsTo(User::class, 'supervisor_id', 'id')->where('role', 'magang');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }
}
