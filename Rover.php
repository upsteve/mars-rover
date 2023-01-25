<?php

namespace MarsRover;

use MarsRover\Command\CommandProcessor;
use MarsRover\Command\CommandProcessorInterface;
use MarsRover\Geo\Position;
use MarsRover\State\StateInterface;

class Rover
{
    private RoverController $roverController;
    private CommandProcessor $commandProcessor;

    function __construct(StateInterface $state, CommandProcessorInterface $commandProcessor = null)
    {
        $this->roverController = new RoverController($state);
        $this->commandProcessor = $commandProcessor;
        $this->commandProcessor->setController($this->roverController);
    }

    function executeCommands(string $commandCodes): bool
    {
        return $this->commandProcessor->execute($commandCodes);
    }

    function getPosition(): Position
    {
        return $this->roverController->getPosition();
    }

    function getDirection(): string
    {
        return $this->roverController->getDirection();
    }

    function getObstacle(): ?Position
    {
        return $this->roverController->getObstacle();
    }
}
