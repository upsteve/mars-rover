<?php

namespace MarsRover;

use MarsRover\Geo\Position;

class Planet
{
    private array $craterPositions;

    function __construct(array $craters)
    {
        $toPosition = fn($coords) => new Position($coords[0], $coords[1]);
        $this->craterPositions = array_map($toPosition, $craters);
    }

    function isCrater(Position $position): bool
    {
        foreach ($this->craterPositions as $crater) {
            if ($crater == $position) return true;
        }
        return false;
    }

    static function default()
    {
        return new Planet([]);
    }
}
