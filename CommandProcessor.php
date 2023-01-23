<?php

namespace MarsRover;

interface CommandInterface2
{
    function execute(): void;
}

class Command2
{
    protected ControlSystem $controlSystem;

    function __construct(ControlSystem $controlSystem)
    {
        $this->controlSystem = $controlSystem;
    }
}

class ForwardCommand2 extends Command2 implements CommandInterface2
{
    function execute(): void
    {
        $this->controlSystem->forward();
    }
}

class BackwardCommand2 extends Command2 implements CommandInterface2
{
    function execute(): void
    {
        $this->controlSystem->backward();
    }
}

class LeftCommand2 extends Command2 implements CommandInterface2
{
    function execute(): void
    {
        $this->controlSystem->rotateLeft();
    }
}

class RightCommand2 extends Command2 implements CommandInterface2
{
    function execute(): void
    {
        $this->controlSystem->rotateRight();
    }
}

class CommandProcessor
{
    protected ControlSystem $controlSystem;

    function __construct(ControlSystem $controlSystem)
    {
        $this->controlSystem = $controlSystem;
    }

    function toCommand(string $command)
    {
        switch ($command) {
            case 'F': return new ForwardCommand2($this->controlSystem);
            case 'B': return new BackwardCommand2($this->controlSystem);
            case 'L': return new LeftCommand2($this->controlSystem);
            case 'R': return new RightCommand2($this->controlSystem);
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
