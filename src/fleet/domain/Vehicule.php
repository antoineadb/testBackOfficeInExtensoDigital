<?php


namespace App\fleet\domain;


class Vehicule
{
    private $registrationNumber;
    private $geolocation;

    public function __construct(string $registrationNumber, Geolocation $geolocation = null)
    {
        $this->registrationNumber = $registrationNumber;
        $this->geolocation = $geolocation;
    }

    public function getRegistrationNumber(): string
    {
        return $this->registrationNumber;
    }

    public function setGeolocation(Geolocation $geolocation): void
    {
        if ($geolocation === $this->geolocation) {
            throw new Exception('This vehicle is already parked at this location.');
        }

        $this->geolocation = $geolocation;
    }
}