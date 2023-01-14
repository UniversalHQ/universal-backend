<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WarData
 *
 * @package App\Models
 * @mixin IdeHelperWar
 */
class War extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
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
     * @return \App\Models\War
     */
    public static function getCurrentWar()
    {
        return self::orderBy('id', 'desc')->first();
    }

    public function mapWarReports()
    {
        return $this->hasMany(MapWarReport::class);
    }

}
