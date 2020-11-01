<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'e_tag',
        'totalEnlistments',
        'colonialCasualties',
        'wardenCasualties',
        'dayOfWar',
        'version',
    ];

    public function mapData()
    {
        return $this->hasMany(MapData::class);
    }

}
