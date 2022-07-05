<?php

namespace App\Services\Map\Points;

class LeafletPoint extends AbstractPoint
{
    protected $leftBoundX = 0;
    protected $rightBoundX = 256;
    protected $bottomBoundY = -256;
    protected $topBoundY = 0;

    protected $mapHight = 256;
    protected $mapWidth = 256;

    //$mapwidth = 12012; // does this number relate to a pixel-size of some image?
    //$ratio = $width / $mapwidth;

    /**
     * @param $y - default is the center of the map
     * @param $x - default is the center of the map
     */
    function __construct($y = -128, $x = 128)
    {
        parent::__construct($y, $x);
    }
}
