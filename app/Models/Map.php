<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Map
 *
 * @package App\Models
 * @property \Illuminate\Database\Eloquent\Builder
 */
class Map extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'e_tag',
    ];

    public function mapWarReports()
    {
        return $this->hasMany(MapWarReport::class);
    }

}
