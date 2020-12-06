<?php


namespace App\fleet\domain;


class Geolocation
{
    private string $latitude;
    private string $longitude;

    public function __construct(string $latitude, string $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getLatitude(): string
    {
        return $this -> latitude;
    }

    public function getLongitude(): string
    {
        return $this -> longitude;
    }

}