<?php

namespace App\Services\Map\Points;

use App\Services\Map\RegionHex;

class RegionCenterPoint extends LeafletPoint
{
    //$mapwidth = 12012; // does this number relate to a pixel-size of some image?
    //$ratio = $width / $mapwidth;

    const HEX_STACK_COUNT = 7;
    public $regionHight; // height of a region is the maps height devided by 7 regions (basin, ..., kalokai)
    public $regionWidth; // region width depends on its height: f_c(k) // TODO Peter: you sure?
    public $sideLength; // side-length of a hex depending on its height: f_c(a)

    function __construct(RegionHex $regionHex)
    {
        $this->regionHight = -$this->mapHight / self::HEX_STACK_COUNT;
        $this->regionWidth = 2 * $this->regionHight / sqrt(3);
        $this->sideLength = sqrt(3) * $this->regionHight / 2;

        $centerPoint = new LeafletPoint();
        $y = $centerPoint->y + $regionHex->getYScalar() * $this->regionHight;
        $x = $centerPoint->x + $regionHex->getXScalar() * $this->regionWidth;


        parent::__construct($y, $x);
    }

    // return list of LeafletPoints describing the outline of this hex
    public function getRegionCornerPoints(): array
    {
        return [
            $this->getLeftCornerPoint(),
            $this->getTopLeftCornerPoint(),
            $this->getTopRightCornerPoint(),
            $this->getRightCornerPoint(),
            $this->getBottomRightCornerPoint(),
            $this->getBottomLeftCornerPoint(),
        ];
    }

    /**
     * @return LeafletPoint
     */
    private function getRightCornerPoint(): LeafletPoint
    {
        $x = $this->x + $this->regionWidth / 2;
        $y = $this->y;

        return new LeafletPoint($y, $x);
    }

    /**
     * @return LeafletPoint
     */
    private function getBottomRightCornerPoint(): LeafletPoint
    {
        $x = $this->x + $this->regionWidth / 4;
        $y = $this->y - $this->regionHight / 2;

        return new LeafletPoint($y, $x);
    }

    /**
     * @return LeafletPoint
     */
    private function getBottomLeftCornerPoint(): LeafletPoint
    {
        $x = $this->x - $this->regionWidth / 4;
        $y = $this->y - $this->regionHight / 2;

        return new LeafletPoint($y, $x);
    }

    /**
     * @return LeafletPoint
     */
    private function getTopRightCornerPoint(): LeafletPoint
    {
        $x = $this->x + $this->regionWidth / 4;
        $y = $this->y + $this->regionHight / 2;

        return new LeafletPoint($y, $x);
    }

    /**
     * @return LeafletPoint
     */
    private function getTopLeftCornerPoint(): LeafletPoint
    {
        $x = $this->x - $this->regionWidth / 4;
        $y = $this->y + $this->regionHight / 2;

        return new LeafletPoint($y, $x);
    }

    /**
     * @return LeafletPoint
     */
    private function getLeftCornerPoint(): LeafletPoint
    {
        $x = $this->x - $this->regionWidth / 2;
        $y = $this->y;

        return new LeafletPoint($y, $x);
    }
}
