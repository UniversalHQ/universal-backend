<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MapTextItem
 *
 * @package App\Models
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property \App\Models\Map map
 * @property string          text
 * @property string          map_marker_type
 * @property string          x
 * @property string          y
 */
class MapTextItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'map_id',
        'text',
        'map_marker_type',
        'x',
        'y',
    ];

    public function map()
    {
        return $this->belongsTo(Map::class);
    }
}
