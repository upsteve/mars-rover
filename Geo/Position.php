<?php

namespace MarsRover\Geo;

class Position extends GeoCoord
{
    function __construct(int $latitude, int $longitude)
    {
        if ($latitude < -90 || $latitude > 90) throw new \InvalidArgumentException("Invalid latitude, must be -90 to 90");
        if ($longitude < -180 || $longitude > 180) throw new \InvalidArgumentException("Invalid longitude, must be -180 to 180");
        parent::__construct($latitude, $longitude);
    }
}
