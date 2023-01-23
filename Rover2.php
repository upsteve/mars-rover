<?php

namespace MarsRover;

class Rover2
{
    private CommandProcessor $commandProcessor;
    private ControlSystem $controlSystem;
    private Vector $direction;
    private Position $position;
    private Position $obstacle;

    function __construct(int $latitude, int $longitude, string $direction, Globe $globe = null)
    {
        $this->controlSystem = new ControlSystem($this, $globe ?? Globe::default());
        $this->commandProcessor = new CommandProcessor($this->controlSystem);
        $this->position = new Position($latitude, $longitude);
        $this->direction = Vector::fromDirection($direction);
    }

    function processCommandCodes(string $commandCodes): bool
    {
        return $this->commandProcessor->processCommandCodes($commandCodes);
    }

    function getPosition(): Position
    {
        return $this->position;
    }

    function getDirection(): string
    {
        return $this->direction->toDirection();
    }

    function getVector(): Vector
    {
        return $this->direction;
    }

    function setVector(Vector $vector): void
    {
        $this->direction = $vector;
    }

    function setPosition(Position $position): void
    {
        $this->position = $position;
    }

    function setObstacle(Position $obstacle): void
    {
        $this->obstacle = $obstacle;
    }

    function getLastObstacle(): ?Position
    {
        return $this->obstacle;
    }
}
