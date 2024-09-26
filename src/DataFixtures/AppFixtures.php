<?php

namespace App\DataFixtures;

use App\Entity\Sandwich;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $ingredients = [
            'Ham', 'Cheese', 'Lettuce', 'Tomato', 'Cucumber',
            'Onion', 'Chicken', 'Bacon', 'Avocado', 'Mayonnaise',
            'Mustard', 'Peppers', 'Bell pepper', 'Egg', 'Tuna',
            'Barbecue sauce', 'Hot sauce', 'Goat cheese',
            'Arugula', 'Carrot'
        ];


        // create 20 sandwich
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $sandwich = new Sandwich();

            $sandwich->setName($faker->name() . ' Sandwich');
            $sandwich->setPrice(mt_rand(10, 100));
            $manager->persist($sandwich);
        }

        $manager->flush();
    }
}
