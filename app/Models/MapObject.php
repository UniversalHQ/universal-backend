<?php

namespace App\Models;

use App\ObjectType;
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
        'lat',
        'lng',
    ];

    protected $casts = [
        'object_type' => ObjectType::class,
    ];

    protected static function boot()
    {
        static::created(function (MapObject $mapObject) {
            $updatedData = array_merge($mapObject->getAttributes(), [
                'map_object_id'     => $mapObject->id,
                'dynamic_timestamp' => $mapObject->map->dynamic_timestamp,
            ]);
            MapObjectUpdate::create($updatedData);
        });

        static::updated(function (MapObject $mapObject) {
            $updatedData = array_merge($mapObject->getChanges(), [
                'map_object_id'     => $mapObject->id,
                'dynamic_timestamp' => $mapObject->map->dynamic_timestamp,
            ]);
            MapObjectUpdate::create($updatedData);
        });

        parent::boot();
    }

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
