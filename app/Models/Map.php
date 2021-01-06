<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Map
 *
 * @package App\Models
 * @mixin IdeHelperMap
 * @property int                                      totalEnlistments
 * @property int                                      colonialCasualties
 * @property int                                      wardenCasualties
 * @property int                                      dayOfWar
 */
class Map extends Model
{
    use HasFactory;

    protected $fillable = [
        'hex_name',
        'name',
        'region_id',
        'report_e_tag',
        'static_e_tag',
        'dynamic_e_tag',
        'dynamic_timestamp',
    ];

    public function scopeActive($query)
    {
        $query->where('active', 1);
    }

    public function mapItems()
    {
        return $this->hasMany(MapItem::class);
    }

    public function mapTextItems()
    {
        return $this->hasMany(MapTextItem::class);
    }

    public function mapObjects()
    {
        return $this->hasMany(MapObject::class);
    }

    public function mapWarReports()
    {
        return $this->hasMany(MapWarReport::class);
    }

    public function warReport()
    {
        return $this->hasOne(MapWarReport::class)->latest('version');
    }

    public function getTotalEnlistmentsAttribute()
    {
        return $this->warReport->totalEnlistments;
    }

    public function getColonialCasualtiesAttribute()
    {
        return $this->warReport->colonialCasualties;
    }

    public function getWardenCasualtiesAttribute()
    {
        return $this->warReport->wardenCasualties;
    }

    public function getDayOfWarAttribute()
    {
        return $this->warReport->dayOfWar;
    }

    public function getVersionAttribute()
    {
        return $this->warReport->version;
    }
}
