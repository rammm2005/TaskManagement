<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MontlyReport extends Model
{
    // use HasFactory;
    protected $table = 'monthly_reports';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'month_year',
        'user_id',
        'content',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
