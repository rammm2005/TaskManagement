<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

    protected $table = 'departments';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $cast = [
        'name',
    ];

    // public function supervisors()
    // {
    //     return $this->hasMany(Supervisor::class);
    // }
}
