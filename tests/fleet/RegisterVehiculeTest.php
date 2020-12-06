<?php
declare(strict_types=1);
namespace App\Tests\fleet;

use App\fleet\domain\Fleet;
use App\fleet\infra\FleetRepository;
use Meyclub\Core\TechnicalBundle\TestCase\TestCase;
use phpDocumentor\GraphViz\Exception;

final class RegisterVehiculeTest extends TestCase
{
    private $userId;
    private $fleetRepository;

    public function setUp(): void
    {
        $this->fleetRepository = new FleetRepository();
    }


    /**
     * @test
     */
    public function canRegisterOneVehiculeIntoFleet()
    {
        $this->addMyFleet($this->getUserId());

        $this->assertTrue(
            $this->fleetRepository->hasVehicleIntoFleet(
                $this->getVehicleRegistrationNumber(),
                $this->getUserId()
            )
        );


    }

    /**
     * @test
     */
    public function cantRegisterSameVehiculeIntoFleet()
    {
        $this->addMyFleet($this->getUserId());
        $fleet = new Fleet($this->getUserId());
        $fleet->registerVehicle($this->getVehicleRegistrationNumber());
        $this->expectException(Exception::class);
    }

    /**
     * @test
     */
    public function canVehiculeBelongToMoreThanOneFleet()
    {
        $this->addMyFleet($this->getNewUserId());
        $fleet = new Fleet($this->getNewUserId());
        $fleet->registerVehicle($this->getVehicleRegistrationNumber());

        $this->assertTrue(
            $this->fleetRepository->hasVehicleIntoFleet(
                $this->getVehicleRegistrationNumber(),
                $this->getNewUserId()
            )
        );

    }

    private function getVehicleRegistrationNumber(): string
    {
        $nonRegisteredVehicleRegistrationNumber = 'U9888lkjlk';
        $this->fleetRepository->addVehicleToFleet($nonRegisteredVehicleRegistrationNumber, $this->getUserId());
        return $nonRegisteredVehicleRegistrationNumber;
    }

    private function getUserId(): string
    {
        $this->userId = "123";
        return $this->userId;
    }

    private function addMyFleet($userId): void
    {
        $this->fleetRepository = new FleetRepository();
        $this->fleetRepository->addFleet($userId);
    }
    private function getNewUserId(): string
    {
        $this->userId = "456";
        return $this->userId;
    }
}