<?php

namespace MarsRover\Command;

use MarsRover\ControllerInterface;

interface CommandProcessorInterface
{
    function setController(ControllerInterface $roverController): void;
    function execute(string $commandCodes): bool;
}
