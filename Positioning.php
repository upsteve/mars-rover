<?php

namespace MarsRover;

class Positioning
{
    private Position $position;
    private Vector $vector;

    function __construct(Position $position, Vector $vector)
    {
        $this->position = $position;
        $this->vector = $vector;
    }

    private function move(Vector $vector): void
    {
        $position = $this->position->normaliseToVector()->add($vector);
        if ($position->hasCrossedPole()) {
            $position = $position->inverseX();
            $this->vector = $this->vector->inverseY();
        }
        $this->position = $position->denormaliseToPosition();
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
}
