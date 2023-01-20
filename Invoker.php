<?php

namespace MarsRover;

interface CommandInterface
{
    function execute(): void;
}

class Command
{
    protected Positioning $positioning;

    function __construct(Positioning $positioning)
    {
        $this->positioning = $positioning;
    }
}

class ForwardCommand extends Command implements CommandInterface
{
    function execute(): void
    {
        $this->positioning->forward();
    }
}

class BackwardCommand extends Command implements CommandInterface
{
    function execute(): void
    {
        $this->positioning->backward();
    }
}

class LeftCommand extends Command implements CommandInterface
{
    function execute(): void
    {
        $this->positioning->rotateLeft();
    }
}

class RightCommand extends Command implements CommandInterface
{
    function execute(): void
    {
        $this->positioning->rotateRight();
    }
}

class Invoker
{
    protected Positioning $positioning;

    function __construct(Positioning $positioning)
    {
        $this->positioning = $positioning;
    }

    function toCommand(string $command)
    {
        switch ($command) {
            case 'F': return new ForwardCommand($this->positioning);
            case 'B': return new BackwardCommand($this->positioning);
            case 'L': return new LeftCommand($this->positioning);
            case 'R': return new RightCommand($this->positioning);
        }
    }

    function processCommandCodes(string $commandCodes): void
    {
        $commands = array_map([$this, 'toCommand'], str_split($commandCodes));
        foreach($commands as $command) {
            $command->execute();
        }
    }
}
