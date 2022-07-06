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
}
