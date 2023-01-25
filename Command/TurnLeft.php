<?php

namespace MarsRover\Command;

class TurnLeft extends Command
{
    function execute(): void
    {
        $this->roverController->rotateLeft();
        //$this->roverController->getState()->rotateLeft($this->roverController);
    }
}
