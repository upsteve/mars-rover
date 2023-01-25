<?php

namespace MarsRover\Command;

class MoveForward extends Command
{
    function execute(): void
    {
        $this->roverController->moveForward();
        //$this->roverController->getState()->moveForward($this->roverController);
    }
}
