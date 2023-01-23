<?php

namespace MarsRover;

use InvalidArgumentException;

class Rover3
{
    private RoverState $roverState;
    private StateProcessor $stateProcessor;


    function __construct(int $latitude, int $longitude, string $direction, Globe $globe = null)
    {
        $this->roverState = new RoverState();
        $this->stateProcessor = new StateProcessor($this->roverState);

        $position = new Position($latitude, $longitude);
        switch($direction) {
            case 'N': $this->roverState->setState(new NorthFacing($position)); break;
            case 'E': $this->roverState->setState(new EastFacing($position)); break;
            case 'S': $this->roverState->setState(new SouthFacing($position)); break;
            case 'W': $this->roverState->setState(new WestFacing($position)); break;
            default: throw new InvalidArgumentException('Invalid direction, must be N, E, S, or W');
        }
    }

    function __construct2(FacingInterface $state)
    {
        $this->roverState = new RoverState();
        $this->roverState->setState($state);
        $this->stateProcessor = new StateProcessor($this->roverState);
    }

    function processCommandCodes(string $commandCodes): bool
    {
        return $this->stateProcessor->processCommandCodes($commandCodes);
    }

    function getPosition(): Position
    {
        return $this->roverState->getPosition();
    }

    function getDirection(): string
    {
        return $this->roverState->getDirection();
    }
}
