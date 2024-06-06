<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;
    protected $table = 'rules';
    protected $fillable = [
        'rule_cluster_id',
        'sensor_id',
        'sensor_operator',
        'sensor_value',
        'actuator_id',
        'actuator_value',
    ];
}

