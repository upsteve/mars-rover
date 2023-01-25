<?php

namespace MarsRover\Archive;

use InvalidArgumentException;
use MarsRover\Command\CommandProcessor;
use MarsRover\Geo\Position;

class Rover
{
    private RoverState $roverState;
    private CommandProcessor $stateProcessor;

    function __construct(StateInterface $state)
    {
        $this->roverState = new RoverState($state);
        $this->stateProcessor = new CommandProcessor($this->roverState);
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
