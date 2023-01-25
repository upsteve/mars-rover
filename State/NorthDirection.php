<?php

namespace MarsRover\State;

use MarsRover\Geo\Vector;

class NorthDirection implements DirectionInterface
{
    function left(): DirectionInterface
    {
        return new WestDirection();
    }

    function right(): DirectionInterface
    {
        return new EastDirection();
    }

    function forward(): Vector
    {
        return new Vector(1, 0);
    }

    function backward(): Vector
    {
        return new Vector(-1, 0);
    }

    function inverse(): DirectionInterface
    {
        return new SouthDirection();
    }

    function toString(): String
    {
        return 'N';
    }
}
