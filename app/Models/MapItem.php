<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MapItem
 *
 * @package App\Models
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property \App\Models\Map map
 * @property string          team_id
 * @property string          icon_type
 * @property string          flags
 * @property decimal         x
 * @property decimal         y
 */
class MapItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'map_id',
        'team_id',
        'icon_type',
        'flags',
        'x',
        'y',
    ];

    public function map()
    {
        return $this->belongsTo(Map::class);
    }
}
