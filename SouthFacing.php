<?php

namespace MarsRover;

class SouthFacing extends State
{
    function rotateLeft(RoverState $roverState)
    {
        $roverState->setState(new EastFacing($this->position));
    }

    function rotateRight(RoverState $roverState)
    {
        $roverState->setState(new WestFacing($this->position));
    }

    function forward(RoverState $roverState)
    {
        $roverState->setState($this->move(new Vector(-1, 0)));
    }

    function backward(RoverState $roverState)
    {
        $roverState->setState($this->move(new Vector(1, 0)));
    }

    function inverse(Position $position): FacingInterface
    {
        return new NorthFacing($position);
    }

    function getDirection(): String
    {
        return 'S';
    }
}
