<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'site_name',
        'site_description',
        'instagram',
        'twitter',
        'facebook',
        'linkedin',
    ];
}
