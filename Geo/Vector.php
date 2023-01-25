<?php

namespace MarsRover\Geo;

class Vector extends GeoCoord
{
    function inverseX(): Vector
    {
        return new Vector($this->latitude(), $this->longitude() + 180);
    }

    function add(Vector $vector): Vector
    {
        return new Vector(
            $this->latitude() + $vector->latitude(),
            $this->longitude() + $vector->longitude());
    }
}
