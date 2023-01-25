<?php

namespace MarsRover\Command;

class MoveBackward extends Command
{
    function execute(): void
    {
        $this->roverController->moveBackward();
        //$this->roverController->getState()->moveBackward($this->roverController);
    }
}
