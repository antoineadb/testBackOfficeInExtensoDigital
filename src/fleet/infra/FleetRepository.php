<?php


namespace App\fleet\infra;


use App\fleet\domain\Fleet;
use App\fleet\domain\Geolocation;

class FleetRepository
{


    private $fleets;

    public function addFleet(string $userId): void
    {
        $this->fleets[$userId] = new Fleet($userId);
    }


    public function hasVehicleIntoFleet($vehicleRegistrationNumber, string $userId)
    {
        $fleet = $this->getFleet($userId);

        if (!isset($fleet)) {
            return false;
        }

        foreach ($fleet->getVehicles() as $vehicle) {
            if ($vehicleRegistrationNumber === $vehicle-> getRegistrationNumber($vehicleRegistrationNumber))
                return true;
        }

        return false;
    }

    public function getFleet(string $userId): ?Fleet
    {
        if (!array_key_exists($userId, $this->fleets)) {
            return null;
        }

        return $this->fleets[$userId];
    }

    public function addVehicleToFleet(string $nonRegisteredVehicleRegistrationNumber, string $userId, Geolocation $geolocation= null): void
    {
        $fleet = $this->getFleet($userId);
        try {
            $fleet->registerVehicle($nonRegisteredVehicleRegistrationNumber, $geolocation);
        } catch (\Exception $e) {
            //@todo
        }
    }

    public function getVehicleGeolocation(string $vehicleRegistrationNumber, string $userId, Geolocation $location)
    {
        return new Geolocation('45.600000', '4.600000');
    }
}