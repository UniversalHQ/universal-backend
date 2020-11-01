<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarData extends Model
{
    use HasFactory;

    protected $fillable = [
        'warId',
        'warNumber',
        'requiredVictoryTowns',
        'winner',
        'conquestStartTime',
        'started_at',
        'conquestEndTime',
        'ended_at',
        'resistanceStartTime',
        'resistance_at',
    ];
}
