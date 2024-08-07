<?php

namespace App\DataFixtures;

use App\Entity\Robot;
use App\Enum\Entity\RobotTypes;
use Faker\Factory as FakerFactory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    private const NUMBER_OF_ROBOTS = 300;
    private const IMAGE_BASE_URL = 'https://robohash.org/'; 

    public function load(ObjectManager $manager): void
    {
        $this->generateRobots($manager);
    }

    private function generateRobots(ObjectManager $manager): void
    {
        $faker = FakerFactory::create();
        for ($i = 0; $i < self::NUMBER_OF_ROBOTS; $i++) {
            $robot = new Robot();
            $robot->setName(ucfirst($faker->word));
            $robot->setType($faker->randomElement(RobotTypes::cases()));
            $robot->setPower($faker->numberBetween(1, 100));
            $randomString = $faker->uuid;
            $robot->setImageUrl(self::IMAGE_BASE_URL  .  hash('md2', $randomString));

            $manager->persist($robot);
            $manager->flush();
        }

    }
}
