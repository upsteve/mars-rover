<?php

namespace MarsRover\State;

use MarsRover\Geo\Position;
use MarsRover\Geo\Vector;
use MarsRover\Planet;
use MarsRover\RoverController;

class RoverState implements StateInterface
{
    private Position $position;
    private DirectionInterface $direction;
    private ?Position $obstacle = null;
    private Planet $planet;

    function __construct(Position $position, DirectionInterface $direction, Planet $planet, ?Position $obstacle = null)
    {
        $this->direction = $direction;
        $this->position = $position;
        $this->planet = $planet;
        $this->obstacle = $obstacle;
    }

    function rotateLeft(RoverController $roverController): void
    {
        $this->turn($roverController, $this->direction->left());
    }

    function rotateRight(RoverController $roverController): void
    {
        $this->turn($roverController, $this->direction->right());
    }

    function moveForward(RoverController $roverController): void
    {
        $this->move($roverController, $this->direction->forward());
    }

    function moveBackward(RoverController $roverController): void
    {
        $this->move($roverController, $this->direction->backward());
    }

    function getPosition(): Position
    {
        return $this->position;
    }

    function getDirection(): DirectionInterface
    {
        return $this->direction;
    }

    function getObstacle(): ?Position
    {
        return $this->obstacle;
    }

    private function turn(RoverController $roverController, DirectionInterface $direction): void
    {
        $roverController->setState(new RoverState($this->position, $direction, $this->planet));
    }

    private function move(RoverController $roverController, Vector $vector): void
    {
        $position = $this->position->normaliseToVector()->add($vector);
        $isPolarCrossing = $position->hasCrossedPole();
        $nextPosition = ($isPolarCrossing ? $position->inverseX() : $position)->denormaliseToPosition();

        if ($this->planet->isCrater($nextPosition)) {
            $roverController->setState(new RoverState($this->position, $this->direction, $this->planet, $nextPosition));
            throw new \Exception("Rover could not complete command due to a crater in it's way!");
        } else {
            $nextDirection = $isPolarCrossing ? $this->direction->inverse() : $this->direction;
            $roverController->setState(new RoverState($nextPosition, $nextDirection, $this->planet, null));
        }
    }
}
