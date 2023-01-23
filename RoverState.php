<?php

namespace MarsRover;

class RoverState
{
    private FacingInterface $state;

    function getState()
    {
        return $this->state;
    }

    function setState(FacingInterface $state)
    {
        $this->state = $state;
    }

    function getPosition()
    {
        return $this->state->getPosition();
    }

    function getDirection()
    {
        return $this->state->getDirection();
    }
}
