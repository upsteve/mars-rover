<?php

namespace MarsRover\Command;

use MarsRover\ControllerInterface;

abstract class Command implements CommandInterface
{
    protected ControllerInterface $roverController;

    function __construct(ControllerInterface $roverController)
    {
        $this->roverController = $roverController;
    }
}
