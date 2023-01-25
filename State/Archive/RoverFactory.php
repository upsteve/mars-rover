<?php

namespace MarsRover\Archive;

use InvalidArgumentException;
use MarsRover\Geo\Position;

class RoverFactory
{
    static function createState(Position $position, string $direction): StateInterface
    {
        switch($direction) {
            case 'N': return new NorthFacing($position);
            case 'E': return new EastFacing($position);
            case 'S': return new SouthFacing($position);
            case 'W': return new WestFacing($position);
            default: throw new InvalidArgumentException('Invalid direction, must be N, E, S, or W');
        }
    }


    static function createRover(int $latitude, int $longitude, string $direction, Globe $globe = null)
    {
        $state = static::createState(new Position($latitude, $longitude), $direction);
        return new Rover($state);
    }

    static function fromState(StateInterface $state)
    {
        return new Rover($state);
    }
}
