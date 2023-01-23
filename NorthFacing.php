<?php

namespace MarsRover;

class NorthFacing extends State
{
    function rotateLeft(RoverState $roverState)
    {
        $roverState->setState(new WestFacing($this->position));
    }

    function rotateRight(RoverState $roverState)
    {
        $roverState->setState(new EastFacing($this->position));
    }

    function forward(RoverState $roverState)
    {
        $roverState->setState($this->move(new Vector(1, 0)));
    }

    function backward(RoverState $roverState)
    {
        $roverState->setState($this->move(new Vector(-1, 0)));
    }

    function inverse(Position $position): FacingInterface
    {
        return new SouthFacing($position);
    }

    function getDirection(): String
    {
        return 'N';
    }
}
