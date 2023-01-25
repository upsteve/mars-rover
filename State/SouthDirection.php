<?php

namespace MarsRover\State;

use MarsRover\Geo\Vector;

class SouthDirection implements DirectionInterface
{
    function left(): DirectionInterface
    {
        return new EastDirection();
    }

    function right(): DirectionInterface
    {
        return new WestDirection();
    }

    function forward(): Vector
    {
        return new Vector(-1, 0);
    }

    function backward(): Vector
    {
        return new Vector(1, 0);
    }

    function inverse(): DirectionInterface
    {
        return new NorthDirection();
    }

    function toString(): String
    {
        return 'S';
    }
}
