<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Map
 *
 * @package App\Models
 * @mixin  \Illuminate\Database\Eloquent\Builder
 * @method active
 * @property string hex_name
 * @property string name
 * @property int    region_id
 * @property string report_e_tag
 * @property string static_e_tag
 * @property string dynamic_e_tag
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
    ];

    public function mapWarReports()
    {
        return $this->hasMany(MapWarReport::class);
    }

    public function scopeActive($query)
    {
        $query->where('active', 1);
    }

}
