<?php
namespace ESGI\UserBundle\DataFixtures\ORM;

use ESGI\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class UserFixtures extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        $i = 1;
        while($i <= 20){
            $user = new User();
            $user->setUsername($faker->userName);
            $user->setPassword($faker->randomElement());
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setEmail($faker->safeEmail);

            $manager->persist($user);
            
            $this->addReference('user-'.$i,$user);

            $i ++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}

