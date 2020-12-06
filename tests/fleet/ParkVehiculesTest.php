<?php


namespace App\Tests\fleet;


use App\fleet\app\ParkVehicule;
use App\fleet\infra\FleetRepository;
use Meyclub\Core\TechnicalBundle\TestCase\TestCase;
use Exception;

class ParkVehiculesTest extends TestCase
{
    protected $fleet;

    /**
     * @test
     */
    public function canParkVehicleAtLocation()
    {
        $fleetRepository = new FleetRepository();
        $fleetRepository->addFleet($this->getUserId());
        $fleetRepository->addVehicleToFleet($this->getVehicleRegistrationNumber(), $this->getUserId());
        $location = new Geolocation('45.600000', '4.600000');
        $parkVehicle = new ParkVehicule($this->getUserId(), $this->getVehicleRegistrationNumber(), $location);

        $this->assertEquals(
            $location,
            $fleetRepository->getVehicleGeolocation($this->getVehicleRegistrationNumber(), $this->getUserId(), $location)
        );

    }

    /**
     * @test
     */
    public function cantFindVehicleToTheSameLocationTwoTimesInARow()
    {
        $fleetRepository = new FleetRepository();
        $fleetRepository->addFleet($this->getUserId());
        $fleetRepository->addVehicleToFleet($this->getVehicleRegistrationNumber(), $this->getUserId());
        $location = new Geolocation('45.600000', '4.600000');
        $parkVehicle = new ParkVehicule($this->getUserId(), $this->getVehicleRegistrationNumber(), $location);
        $this->expectException(Exception::class);
    }

    private function getUserId(): string
    {
        return "123";
    }

    private function getVehicleRegistrationNumber() : string
    {
        return  'AJKKJ67655';
    }
}