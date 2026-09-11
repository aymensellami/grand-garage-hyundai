<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\BlogPost;
use App\Entity\Entreprise;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        // Create a user
        $user = new User();
        $user->setEmail('user@test.com');
        $user->setPassword('password');
        $manager->persist($user);

        
        


        $manager->flush();
    }
}
