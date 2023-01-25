<?php

namespace MarsRover\Archive;

use MarsRover\Geo\Position;
use MarsRover\Geo\Vector;

class WestFacing extends State
{
    function rotateLeft(RoverState $roverState)
    {
        $roverState->setState(new SouthFacing($this->position));
    }

    function rotateRight(RoverState $roverState)
    {
        $roverState->setState(new NorthFacing($this->position));
    }

    function forward(RoverState $roverState)
    {
        $roverState->setState($this->move(new Vector(0, -1)));
    }

    function backward(RoverState $roverState)
    {
        $roverState->setState($this->move(new Vector(0, 1)));
    }

    function inverse(Position $position): StateInterface
    {
        throw new \DomainException("Only North/South directions should be inverted on crossing a pole");
    }

    function getDirection(): String
    {
        return 'W';
    }
}
