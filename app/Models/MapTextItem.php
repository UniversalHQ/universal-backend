<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MapTextItem
 *
 * @package App\Models
 * @mixin IdeHelperMapTextItem
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
