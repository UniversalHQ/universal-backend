<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MapObjectUpdate
 *
 * @package App\Models
 * @mixin IdeHelperMapObjectUpdate
 */
class MapObjectUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'map_object_id',
        'team_id',
        'icon_type',
        'object_type',
        'is_scorched',
        'is_victory_base',
        'is_build_site',
    ];
}
