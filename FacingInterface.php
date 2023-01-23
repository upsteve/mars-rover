<?php

namespace MarsRover;

interface FacingInterface {
    function getPosition();
    function rotateLeft(RoverState $roverState);
    function rotateRight(RoverState $roverState);
    function forward(RoverState $roverState);
    function backward(RoverState $roverState);
    function inverse(Position $position): FacingInterface;
    function getDirection(): String;
}
