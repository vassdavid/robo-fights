<?php
namespace App\Service\Robot;

use App\Entity\Robot;
use App\Repository\RobotRepository;
use App\Dto\Request\RobotFightRequestDto;
use Doctrine\ORM\EntityNotFoundException;
use App\Exception\EqualRobotPowerException;

class RobotFightService
{
    public function __construct(
        private RobotRepository $robotRepository,
    )
    {

    }

    private function findRobotOrFail(int $id): Robot
    {
        $robot = $this->robotRepository->find($id);
        if(!$robot instanceof Robot) {
            throw new EntityNotFoundException('Robot not found with id: ' . $id . ' !');
        }

        return $robot;
    }

    public function getStrongerRobot(RobotFightRequestDto $dto): Robot
    {
        $robot1 = $this->findRobotOrFail($dto->robot1Id);
        $robot2 = $this->findRobotOrFail($dto->robot2Id);

        if($robot1->getPower() == $robot2->getPower()) {
            throw new EqualRobotPowerException('Both robots have equal power.');
        }

        if( $robot1->getPower() > $robot2->getPower()) {
            return $robot1;
        }

        return $robot2;
    }
}