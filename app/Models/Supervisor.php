<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $table = 'supervisors';
    protected $primaryKey = 'supervisor_id';
    public $timestamps = true;

    public function interns()
    {
        return $this->hasMany(Intern::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
