<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapData extends Model
{
    use HasFactory;

    protected $fillable= [
        'map_id',
        'e_tag',
        'totalEnlistments',
        'colonialCasualties',
        'wardenCasualties',
        'dayOfWar',
        'version',
    ];

    public function map()
    {
        return $this->belongsTo(Map::class);
    }



}
