<?php


namespace App\fleet\app;


class RegisterVehicule
{

    private $fleetRepository;

    public function __construct($fleetRepository)
    {
        $this->fleetRepository = $fleetRepository;
    }


    public function getFleetRepository()
    {
        return $this->fleetRepository;
    }

    public function setFleetRepository($fleetRepository): void
    {
        $this->fleetRepository = $fleetRepository;
    }


}