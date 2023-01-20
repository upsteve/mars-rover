<?php

namespace MarsRover;

class Rover extends Invoker
{
    //private Positioning $positioning;

    function __construct(int $latitude, int $longitude, string $direction)
    {
        // $this->positioning = new Positioning(
        //    new Position($latitude, $longitude),
        //    Vector::fromDirection($direction));

        parent::__construct(new Positioning(
            new Position($latitude, $longitude),
            Vector::fromDirection($direction)));
    }

    function getPosition(): Position
    {
        return $this->positioning->position();
    }

    function getDirection(): string
    {
        return $this->positioning->direction();
    }

    /*
    function command(string $command): void
    {
        if ($command == 'F') {
            $this->positioning->forward();
        }

        if ($command == 'B') {
            $this->positioning->backward();
        }

        if ($command == 'L') {
            $this->positioning->rotateLeft();
        }

        if ($command == 'R') {
            $this->positioning->rotateRight();
        }
    }
    */
}
