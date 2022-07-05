<?php

namespace App\Services\Map\Points;

abstract class AbstractPoint
{
    // x/y bounds
    protected $leftBoundX; // low
    protected $rightBoundX; // high
    protected $bottomBoundY; // low
    protected $topBoundY; // high

    function __construct(public $y, public $x)
    {
        $this->assertBounds();
    }

    function assertBounds()
    {
        $this->assertXBounds();
        $this->assertYBounds();
    }

    /**
     * @return void
     */
    private function assertXBounds(): void
    {
        $absoluteLowestXBound = min($this->leftBoundX, $this->rightBoundX);
        $absoluteHighestXBound = max($this->leftBoundX, $this->rightBoundX);
        if (!($absoluteLowestXBound <= $this->x && $this->x <= $absoluteHighestXBound)) {
            throw new \Exception("x-Value exceeds bounds: " . $absoluteLowestXBound . ':' . $absoluteHighestXBound . ", " . $this->x);
        }
    }

    /**
     * @return void
     */
    private function assertYBounds(): void
    {
        $absoluteLowestYBound = min($this->bottomBoundY, $this->topBoundY);
        $absoluteHighestYBound = max($this->bottomBoundY, $this->topBoundY);
        if (!($absoluteLowestYBound <= $this->y && $this->y <= $absoluteHighestYBound)) {
            throw new \Exception("y-Value exceeds bounds: " . $absoluteLowestYBound . ':' . $absoluteHighestYBound . ", " . $this->y);
        }
    }

    public function toArray(): array
    {
        return [$this->x, $this->y];
    }
}
