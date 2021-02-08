<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i=0;$i<=50;$i++){

            $property = new Property();
            $property->setTitle($faker->word(3, true))
                ->setDescription($faker->sentence(rand(1,4)))
                ->setSurface($faker->numberBetween(10,500))
                ->setSold($faker->numberBetween(0,1))
                ->setRooms($faker->numberBetween(2,10))
                ->setPrice($faker->numberBetween(100000,10000000))
                ->setPostalCode(rand(10000,99999))
                ->setFloor(rand(0,15))
                ->setHeat($faker->numberBetween(0,count(Property::HEAT)-1))
                ->setCreatedAt($faker->dateTime())
                ->setCity($faker->city)
                ->setAddress($faker->address)
                ->setBedrooms(rand(1,9));
        $manager->persist($property);
        }
        $manager->flush();
    }
}
