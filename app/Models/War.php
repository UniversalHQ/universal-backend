<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WarData
 *
 * @package App\Models
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property string                     war_id
 * @property integer                    war_number
 * @property integer                    required_victory_towns
 * @property string                     winner
 * @property string                     conquest_start_time
 * @property \Illuminate\Support\Carbon started_at
 * @property string                     conquest_end_time
 * @property \Illuminate\Support\Carbon ended_at
 * @property string                     resistance_start_time
 * @property \Illuminate\Support\Carbon resistance_at
 * @property string                     active_tiles_string
 * @property string                     active_resistance_tiles_string
 */
class War extends Model
{
    use HasFactory;

    protected $fillable = [
        'war_id',
        'war_number',
        'required_victory_towns',
        'winner',
        'conquest_start_time',
        'started_at',
        'conquest_end_time',
        'ended_at',
        'resistance_start_time',
        'resistance_at',
        'active_tiles_string',
        'active_resistance_tiles_string',
    ];

    /**
     *
     *
     * @return \App\Models\War
     */
    public static function getCurrentWar()
    {
        return self::orderBy('war_id', 'desc')->first();
    }

    public function mapWarReports()
    {
        return $this->hasMany(MapWarReport::class);
    }

}
