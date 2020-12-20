<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MapObject
 *
 * @package App\Models
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property string                  map_id
 * @property string                  team_id
 * @property string                  text
 * @property string                  object_type
 * @property integer                 icon_type
 * @property boolean                 is_scorched
 * @property boolean                 is_victory_base
 * @property boolean                 is_build_site
 * @property decimal                 x
 * @property decimal                 y
 * @property \App\Models\Map         map
 * @property \App\Models\MapTextItem mapTextItem
 * @property \App\Models\MapItem     mapItem
 */
class MapObject extends Model
{
    use HasFactory;

    protected $fillable = [
        'map_id',
        'team_id',
        'text',
        'object_type',
        'icon_type',
        'is_scorched',
        'is_victory_base',
        'is_build_site',
        'x',
        'y',
    ];

    public function map()
    {
        return $this->belongsTo(Map::class);
    }

    public function mapTextItem()
    {
        return $this->hasOne(MapTextItem::class);
    }

    public function mapItem()
    {
        return $this->hasOne(MapItem::class);
    }
}
