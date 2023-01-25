<?php

namespace MarsRover;

//use MarsRover\Geo\Position;
//use MarsRover\State\StateInterface;

interface ControllerInterface
{
    //function setState(StateInterface $state): void;
    //function getPosition(): Position;
    //function getDirection(): string;
    //function getObstacle(): ?Position;
    function moveForward(): void;
    function moveBackward(): void;
    function rotateLeft(): void;
    function rotateRight(): void;
}
