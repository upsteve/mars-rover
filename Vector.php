<?php

namespace MarsRover;

class Vector extends GeoCoord
{
    static function fromDirection(string $direction, int $speed = 1): Vector
    {
        switch ($direction) {
            case 'N':
                return new Vector($speed, 0);
            case 'S':
                return new Vector(-$speed, 0);
            case 'E':
                return new Vector(0, $speed);
            case 'W':
                return new Vector(0, -$speed);
            default:
                throw new \InvalidArgumentException("Invalid direction, must be N, E, S, or W");
        }
    }

    function toDirection(): string | false
    {
        if ($this->latitude() > 0 && $this->longitude() == 0) return 'N';
        if ($this->latitude() < 0 && $this->longitude() == 0) return 'S';
        if ($this->latitude() == 0 && $this->longitude() > 0) return 'E';
        if ($this->latitude() == 0 && $this->longitude() < 0) return 'W';
        return false;
    }

    function inverse(): Vector
    {
        return new Vector(-$this->latitude(), -$this->longitude());
    }

    function inverseX(): Vector
    {
        return new Vector($this->latitude(), $this->longitude() + 180);
    }

    function inverseY(): Vector
    {
        return new Vector(-$this->latitude(), $this->longitude());
    }

    function rotate90(): Vector
    {
        return new Vector(-$this->longitude(), $this->latitude());
    }

    function rotate270(): Vector
    {
        return new Vector($this->longitude(), -$this->latitude());
    }

    function add(Vector $vector): Vector
    {
        return new Vector(
            $this->latitude() + $vector->latitude(),
            $this->longitude() + $vector->longitude());
    }
}
