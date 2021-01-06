<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MapWarReport
 *
 * @package App\Models
 * @mixin IdeHelperMapWarReport
 */
class MapWarReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'war_id',
        'map_id',
        'name',
        'e_tag',
        'totalEnlistments',
        'colonialCasualties',
        'wardenCasualties',
        'dayOfWar',
        'version',
    ];

    public function map()
    {
        return $this->belongsTo(Map::class);
    }

    public function war()
    {
        return $this->belongsTo(War::class);
    }

}
