<?php

namespace MarsRover;

use InvalidArgumentException;
use MarsRover\Command\CommandProcessor;
use MarsRover\Geo\Position;
use MarsRover\State\DirectionInterface;
use MarsRover\State\EastDirection;
use MarsRover\State\NorthDirection;
use MarsRover\State\SouthDirection;
use MarsRover\State\RoverState;
use MarsRover\State\StateInterface;
use MarsRover\State\WestDirection;

class RoverFactory
{
    private static function getDirection(string $direction): DirectionInterface
    {
        switch($direction) {
            case 'N': return new NorthDirection();
            case 'E': return new EastDirection();
            case 'S': return new SouthDirection();
            case 'W': return new WestDirection();
            default: throw new InvalidArgumentException('Invalid direction, must be N, E, S, or W');
        }
    }

    static function createRover(int $latitude, int $longitude, string $direction, Planet $planet = null): Rover
    {
        $state = new RoverState(new Position($latitude, $longitude), static::getDirection($direction), $planet ?? Planet::default());
        return new Rover($state, new CommandProcessor());
    }

    static function fromState(StateInterface $state): Rover
    {
        return new Rover($state, new CommandProcessor());
    }
}
