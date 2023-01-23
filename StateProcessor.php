<?php

namespace MarsRover;

interface CommandInterface3
{
    function execute(): void;
}

class Command3
{
    protected RoverState $roverState;

    function __construct(RoverState $roverState)
    {
        $this->roverState = $roverState;
    }
}

class ForwardCommand3 extends Command3 implements CommandInterface3
{
    function execute(): void
    {
        $this->roverState->getState()->forward($this->roverState);
    }
}

class BackwardCommand3 extends Command3 implements CommandInterface3
{
    function execute(): void
    {
        $this->roverState->getState()->backward($this->roverState);
    }
}

class LeftCommand3 extends Command3 implements CommandInterface3
{
    function execute(): void
    {
        $this->roverState->getState()->rotateLeft($this->roverState);
    }
}

class RightCommand3 extends Command3 implements CommandInterface3
{
    function execute(): void
    {
        $this->roverState->getState()->rotateRight($this->roverState);
    }
}

class StateProcessor
{
    protected RoverState $roverState;

    function __construct(RoverState $roverState)
    {
        $this->roverState = $roverState;
    }

    function toCommand(string $command)
    {
        switch ($command) {
            case 'F': return new ForwardCommand3($this->roverState);
            case 'B': return new BackwardCommand3($this->roverState);
            case 'L': return new LeftCommand3($this->roverState);
            case 'R': return new RightCommand3($this->roverState);
        }
    }

    function processCommandCodes(string $commandCodes): bool
    {
        $commands = array_map([$this, 'toCommand'], str_split($commandCodes));
        foreach($commands as $command) {
            try {
                $command->execute();
            } catch (\Exception) {
                return false;
            }
        }
        return true;
    }
}
