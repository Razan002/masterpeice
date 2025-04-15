<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id', 'name', 'description'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
