<?php

namespace MarsRover\State;

use MarsRover\Geo\Vector;

interface DirectionInterface
{
    function left(): DirectionInterface;
    function right(): DirectionInterface;
    function forward(): Vector;
    function backward(): Vector;
    function inverse(): DirectionInterface;
    function toString(): string;
}
