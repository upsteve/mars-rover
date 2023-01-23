<?php

namespace MarsRover;

class Positioning
{
    private Position $position;
    private Vector $vector;
    private Globe $globe;
    private Position $lastObstacle;

    function __construct(Position $position, Vector $vector, Globe $globe)
    {
        $this->position = $position;
        $this->vector = $vector;
        $this->globe = $globe;
    }

    private function move(Vector $vector): void
    {
        $position = $this->position->normaliseToVector()->add($vector);
        $isPolarCrossing = $position->hasCrossedPole();
        if ($isPolarCrossing) $position = $position->inverseX();
        $newPosition = $position->denormaliseToPosition();

        if ($this->globe->isCrater($newPosition)) {
            $this->lastObstacle = $newPosition;
            throw new \Exception("Rover could not complete command due to a crater in it's way!");
        }
        $this->position = $newPosition;
        if ($isPolarCrossing) $this->vector = $this->vector->inverseY();
    }

    function forward(): void
    {
        $this->move($this->vector);
    }

    function backward(): void
    {
        $this->move($this->vector->inverse());
    }

    function rotateLeft(): void
    {
        $this->vector = $this->vector->rotate270();
    }

    function rotateRight(): void
    {
        $this->vector = $this->vector->rotate90();
    }

    function direction(): string
    {
        return $this->vector->toDirection();
    }

    function position(): Position
    {
        return $this->position;
    }

    function lastObstacle(): Position
    {
        return $this->lastObstacle;
    }
}
