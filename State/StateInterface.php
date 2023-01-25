<?php

namespace MarsRover\State;

use MarsRover\Geo\Position;
use MarsRover\RoverController;

interface StateInterface
{
    function getPosition(): Position;
    function getDirection(): DirectionInterface;
    function getObstacle(): ?Position;
    function rotateLeft(RoverController $roverController): void;
    function rotateRight(RoverController $roverController): void;
    function moveForward(RoverController $roverController): void;
    function moveBackward(RoverController $roverController): void;
}
