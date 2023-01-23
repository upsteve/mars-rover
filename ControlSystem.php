<?php

namespace MarsRover;

class ControlSystem
{
    private Rover2 $rover;
    private Globe $globe;

    function __construct(Rover2 $rover, Globe $globe)
    {
        $this->rover = $rover;
        $this->globe = $globe;
    }

    private function move(Vector $vector): void
    {
        $position = $this->rover->getPosition()->normaliseToVector()->add($vector);
        $isPolarCrossing = $position->hasCrossedPole();
        $newPosition = ($isPolarCrossing ? $position->inverseX() : $position)->denormaliseToPosition();

        if ($this->globe->isCrater($newPosition)) {
            $this->rover->setObstacle($newPosition);
            throw new \Exception("Rover could not complete command due to a crater in it's way!");
        }

        $this->rover->setPosition($newPosition);
        if ($isPolarCrossing) $this->rover->setVector($this->rover->getVector()->inverseY());
    }

    function forward(): void
    {
        $this->move($this->rover->getVector());
    }

    function backward(): void
    {
        $this->move($this->rover->getVector()->inverse());
    }

    function rotateLeft(): void
    {
        $this->rover->setVector($this->rover->getVector()->rotate270());
    }

    function rotateRight(): void
    {
        $this->rover->setVector($this->rover->getVector()->rotate90());
    }
}
