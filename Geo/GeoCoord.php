<?php

namespace MarsRover\Geo;

class GeoCoord
{
    private int $latitude;
    private int $longitude;

    function __construct(int $latitude, int $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    private static function mod(int $number, int $divisor): int
    {
        $remainder = $number % $divisor;
        return $remainder < 0 ? ($remainder + $divisor) % $divisor : $remainder;
    }

    function latitude(): int
    {
        return $this->latitude;
    }

    function longitude(): int
    {
        return $this->longitude;
    }

    function hasCrossedPole(): bool
    {
        $latitude = self::mod($this->latitude, 360); // 0 to 359
        return $latitude > 180;
    }

    function normaliseToVector(): Vector
    {
        return new Vector(
            $this->latitude + 90, // Latitude -90 to 90, normalised as 0 to 180
            $this->longitude + 180); // Longitude -180 to 180, normalised as 0 to 360
    }

    function denormaliseToPosition(): Position
    {
        $latitude = self::mod($this->latitude, 360); // 0 to 359
        $latitude = $latitude <= 180 ? $latitude - 90 : 270 - $latitude; // 0 to 180 => -90 to 90, 181 to 359 => 89 to -89

        $longitude = self::mod($this->longitude, 360); // 0 to 359
        $longitude = $longitude > 0 ? $longitude - 180 : 180; // -179 to 180

        return new Position($latitude, $longitude);
    }
}
