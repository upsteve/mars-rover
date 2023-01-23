<?php

namespace MarsRover;

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

    function inverse(Position $position): FacingInterface
    {
        return new EastFacing($position);
    }

    function getDirection(): String
    {
        return 'W';
    }
}
