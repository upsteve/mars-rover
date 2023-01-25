<?php

namespace MarsRover\Command;

use InvalidArgumentException;
use MarsRover\ControllerInterface;

class CommandProcessor implements CommandProcessorInterface
{
    protected ControllerInterface $roverController;

    /*
    function __construct(ControllerInterface $roverController)
    {
        $this->roverController = $roverController;
    }
    */

    private function toCommand(string $command)
    {
        switch ($command) {
            case 'F': return new MoveForward($this->roverController);
            case 'B': return new MoveBackward($this->roverController);
            case 'L': return new TurnLeft($this->roverController);
            case 'R': return new TurnRight($this->roverController);
            default: throw new InvalidArgumentException("Invalid command string");
        }
    }

    private function convertToCommands(string $commandCodes): array
    {
        return array_map([$this, 'toCommand'], str_split($commandCodes));
    }

    private function processCommands(array $commands): bool
    {
        try {
            array_walk($commands, fn($command) => $command->execute());
        } catch (\Exception) {
            return false;
        }
        return true;
    }

    function setController(ControllerInterface $roverController): void
    {
        $this->roverController = $roverController;
    }

    function execute(string $commandCodes): bool
    {
        $commands = $this->convertToCommands($commandCodes);
        return $this->processCommands($commands);
    }
}
