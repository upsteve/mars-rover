<?php

namespace MarsRover\Archive;

class RoverState
{
    private StateInterface $state;

    function __construct(StateInterface $state)
    {
        $this->setState($state);
    }

    function getState()
    {
        return $this->state;
    }

    function setState(StateInterface $state)
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
