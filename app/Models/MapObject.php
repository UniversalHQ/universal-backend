<?php

namespace App\Models;

use App\Events\MapObjectUpdatedEvent;
use App\ObjectType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * Class MapObject
 *
 * @package App\Models
 * @mixin IdeHelperMapObject
 * @property string assetUrl
 * @property ObjectType object_type
 * @property string $team_id
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
        'object_type'     => ObjectType::class,
        'is_scorched'     => 'boolean',
        'is_victory_base' => 'boolean',
        'is_build_site'   => 'boolean',
    ];

    protected static function boot()
    {
        static::saved(function (MapObject $mapObject) {
            if (empty($mapObject->getChanges())) {
                return;
            }
            Log::warning('"changes"', $mapObject->getChanges());
            $updatedData = array_merge($mapObject->getChanges(), [
                'map_object_id'     => $mapObject->id,
                'dynamic_timestamp' => $mapObject->map->dynamic_timestamp,
            ]);
            MapObjectUpdate::create($updatedData);
            event(new MapObjectUpdatedEvent($mapObject));
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

    public function getRangesAttribute()
    {
        return ObjectType::getRanges($this->object_type);
    }

    public function getAssetUrlAttribute()
    {
        $assetName = ObjectType::getAssetName($this->object_type, $this->team_id);
        //if ($this->is_victory_base) {
        //    $assetName = 'civiccenter';
        //}
        //if ($this->is_scorched) {
        //    $assetName = 'scorchedtown';
        //}

        return 'https://raw.githubusercontent.com/UniversalHQ/universal-images/master/MapIcons/' . $assetName . '.png';
    }

    public function getCategoryAttribute()
    {
        return ObjectType::categoryForCase($this->object_type);
    }
}
