<?php

namespace MarsRover\Archive;

use MarsRover\Geo\Position;

interface StateInterface
{
    function getPosition();
    function rotateLeft(RoverState $roverState);
    function rotateRight(RoverState $roverState);
    function forward(RoverState $roverState);
    function backward(RoverState $roverState);
    function inverse(Position $position): StateInterface;
    function getDirection(): string;
}

