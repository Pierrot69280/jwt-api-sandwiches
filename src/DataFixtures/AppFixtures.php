<?php

namespace App\DataFixtures;

use App\Entity\Ingredients;
use App\Entity\Sandwich;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create();

        $ingredients = [
            'Ham', 'Cheese', 'Lettuce', 'Tomato', 'Cucumber',
            'Onion', 'Chicken', 'Bacon', 'Avocado', 'Mayonnaise',
            'Mustard', 'Peppers', 'Bell pepper', 'Egg', 'Tuna',
            'Barbecue sauce', 'Hot sauce', 'Goat cheese',
            'Arugula', 'Carrot'
        ];

        foreach ($ingredients as $ingredientName) {
            $ingredient = new Ingredients();
            $ingredient->setName($ingredientName);
            $manager->persist($ingredient);
        }
        $manager->flush();

        $ingredients = $manager->getRepository(Ingredients::class)->findAll();


        // create 20 sandwich
        for ($i = 0; $i < 20; $i++) {
            $sandwich = new Sandwich();

            $sandwich->setName($faker->name() . ' Sandwich');
            $sandwich->setPrice($faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10));
            $ingredientsNbr = rand(1,count($ingredients));
            $tempIngredients = $ingredients;
            for ($j = 0; $j < $ingredientsNbr; $j++) {
                $randIndex = array_rand($tempIngredients);
                $ingredient = $tempIngredients[$randIndex];
                unset($tempIngredients[$randIndex]);
                $sandwich->addIngredient($ingredient);
            }
            $manager->persist($sandwich);
        }

        $manager->flush();
    }
}
