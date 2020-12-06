<?php


namespace App\fleet\domain;

use App\fleet\domain\Geolocation;
use Exception;

class Fleet
{

    private $userId;
    private $vehicles = array();

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    public function getVehicles(): array
    {
        return $this->vehicles;
    }

    public function registerVehicle(string $registrationNumber, Geolocation $geolocation = null): void
    {
        $vehicle = new Vehicle($registrationNumber, $geolocation);

        if (array_key_exists($registrationNumber, $this->vehicles)) {
            throw new Exception('this vehicle has already been registered into your fleet');
        }

        $this->vehicles[$registrationNumber] = $vehicle;
    }

    public function getVehicle(string $registrationNumber): ?Vehicle
    {
        foreach ($this->vehicles as $vehicle) {
            if ($registrationNumber === $vehicle->getRegistrationNumber()) {
                return $vehicle;
            }
        }

        return null;
    }
}