<?php

namespace MarsRover\Command;

class TurnRight extends Command
{
    function execute(): void
    {
        $this->roverController->rotateRight();
        //$this->roverController->getState()->rotateRight($this->roverController);
    }
}
