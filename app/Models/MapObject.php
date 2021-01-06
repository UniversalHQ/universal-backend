<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MapObject
 *
 * @package App\Models
 * @mixin IdeHelperMapObject
 */
class MapObject extends Model
{
    use HasFactory;

    protected $fillable = [
        'map_id',
        'war_id',
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
