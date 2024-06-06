<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $table = 'datas';
    protected $fillable = [
        'device_id',
        'value',
        'max_value',
        'min_value',
    ];
}
