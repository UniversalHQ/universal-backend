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

        $upperLeftCorner = new LeafletPoint($center->y - $center->regionHight / 2, $center->x - $center->regionWidth / 2);

        // very wrong but at least in the right hex:
        return new LeafletPoint(
            $upperLeftCorner->y + $this->y * $center->regionHight,
            $upperLeftCorner->x + $this->x * $center->regionWidth
        );
    }
}
