<?php

namespace MarsRover\State;

use MarsRover\Geo\Vector;

class WestDirection implements DirectionInterface
{
    function left(): DirectionInterface
    {
        return new SouthDirection();
    }

    function right(): DirectionInterface
    {
        return new NorthDirection();
    }

    function forward(): Vector
    {
        return new Vector(0, -1);
    }

    function backward(): Vector
    {
        return new Vector(0, 1);
    }

    function inverse(): DirectionInterface
    {
        throw new \DomainException("Only North/South directions should be inverted on crossing a pole");
    }

    function toString(): String
    {
        return 'W';
    }
}
