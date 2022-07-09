<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MapItem
 *
 * @package App\Models
 * @mixin IdeHelperMapItem
 */
class MapItem extends Model
{
    use HasFactory;

    public const     IS_VICTORY_BASE = 1;
    public const     IS_BUILD_SITE = 4;
    public const     IS_SCORCHED = 10;
    public const     IS_TOWN_CLAIMED = 20;

    protected $fillable = [
        'map_id',
        'team_id',
        'icon_type',
        'flags',
        'x',
        'y',
        'lat',
        'lng',
    ];

    public function map()
    {
        return $this->belongsTo(Map::class);
    }

    public function mapObject()
    {
        return $this->belongsTo(MapObject::class);
    }

    public function isVictoryBase()
    {
        return ($this->flags & self::IS_VICTORY_BASE) === self::IS_VICTORY_BASE;
    }

    public function isBuildSite()
    {
        return ($this->flags & self::IS_BUILD_SITE) === self::IS_BUILD_SITE;
    }

    public function isScorched()
    {
        return ($this->flags & self::IS_SCORCHED) === self::IS_SCORCHED;
    }
}
