<?php
namespace ESGI\BlogBundle\DataFixtures\ORM;

use ESGI\BlogBundle\Entity\Post;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;

class PostFixtures extends  AbstractFixture implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$faker = \Faker\Factory::create();
		echo $faker->city;
		echo $faker->city;
		$i = 1;
		while($i <= 100){
			$post = new Post();
			$post->setTitle($faker->realText($maxNbChars = 100, $indexSize = 2));
			$post->setBody($faker->realText($maxNbChars = 400, $indexSize = 2));
			$post->setIsPublished($i%2);
			
			$rand = rand(1,10);
			$post->setCategory($this->getReference('category-'.$rand));

			$manager->persist($post);

			$i ++;
		}

		$manager->flush();
	}

	public function getOrder()
	{
		return 2;
	}
}

