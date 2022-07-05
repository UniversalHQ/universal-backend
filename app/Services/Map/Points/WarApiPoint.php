<?php

namespace App\Services\Map\Points;

use App\Services\Map\LPoint;
use App\Services\Map\RegionHex;

/**
 * those points are
 * in a coordinate system that is bounded by [1.0, 1.0]
 * relative to the map they are on
 */
class WarApiPoint extends AbstractPoint
{
    protected $leftBoundX = 0;
    protected $rightBoundX = 1;
    protected $bottomBoundY = 1.06;
    protected $topBoundY = 0;

    public function __construct($y, $x, public RegionHex $regionHex)
    {
        parent::__construct($y, $x);
    }

    public function getLeafletPoint()
    {
        $center = new RegionCenterPoint($this->regionHex);
        // very wrong but at least in the right hex:
        return new LeafletPoint($center->y + $this->y * 10, $center->x + $this->x * 10);
    }
}
