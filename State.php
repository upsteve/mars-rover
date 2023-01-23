<?php

namespace MarsRover;

abstract class State implements FacingInterface
{
    protected Position $position;

    function __construct(Position $position)
    {
        $this->position = $position;
    }

    function getPosition()
    {
        return $this->position;
    }

    function move(Vector $vector): State
    {
        $position = $this->position->normaliseToVector()->add($vector);
        $isPolarCrossing = $position->hasCrossedPole();
        $newPosition = ($isPolarCrossing ? $position->inverseX() : $position)->denormaliseToPosition();

        // TODO
        //if ($this->globe->isCrater($newPosition)) {
            //$this->rover->setObstacle($newPosition);
            //throw new \Exception("Rover could not complete command due to a crater in it's way!");
        //}

        return $isPolarCrossing ? $this->inverse($newPosition) : new $this($newPosition);
    }
}
