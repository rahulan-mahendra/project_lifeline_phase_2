<?php

namespace App\Models;

use App\Casts\TimeCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OpenHour extends Model
{
    use HasFactory;

    protected $casts = [
        'open_time' => TimeCast::class,
        'close_time' => TimeCast::class,
    ];

}
