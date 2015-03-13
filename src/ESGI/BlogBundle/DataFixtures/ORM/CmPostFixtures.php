<?php
namespace ESGI\BlogBundle\DataFixtures\ORM;

use ESGI\BlogBundle\Entity\Post;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class CmPostFixtures extends  AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        $i = 1;
        while($i <= 100){
            $post = new Post();
            $post->setTitle($faker->realText($maxNbChars = 100, $indexSize = 2));
            $post->setBody($faker->realText($maxNbChars = 400, $indexSize = 2));
            $post->setIsPublished($i%2);

            $rand = rand(1,10);
            $post->setCategory($this->getReference('category-'.$rand));
            $rand = rand(1,20);
            $post->setAuthor($this->getReference('user-'.$rand));

            $manager->persist($post);
            
            $this->addReference('post-'.$i,$post);

            $i ++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}

