<?php

namespace MarsRover;

use MarsRover\Geo\Position;
use MarsRover\State\RoverState;
use MarsRover\State\StateInterface;

class RoverController implements ControllerInterface
{
    private StateInterface $state;

    function __construct(StateInterface $state)
    {
        $this->setState($state);
    }

    function setState(StateInterface $state): void
    {
        $this->state = $state;
    }

    function getPosition(): Position
    {
        return $this->state->getPosition();
    }

    function getDirection(): string
    {
        return $this->state->getDirection()->toString();
    }

    function getObstacle(): ?Position
    {
        return $this->state->getObstacle();
    }

    function moveForward(): void
    {
        $this->state->moveForward($this);
    }

    function moveBackward(): void
    {
        $this->state->moveBackward($this);
    }

    function rotateLeft(): void
    {
        $this->state->rotateLeft($this);
    }

    function rotateRight(): void
    {
        $this->state->rotateRight($this);
    }
}
