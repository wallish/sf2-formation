<?php
namespace ESGI\BlogBundle\DataFixtures\ORM;

use ESGI\BlogBundle\Entity\Category;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;

//use Doctrine\Common\Collections\ArrayCollection;

class CategoryFixtures extends  AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $i = 1;
        $faker = \Faker\Factory::create('fr_FR');
        while ($i <= 10) {
            $category = new Category();
            $category->setName($faker->word);
            $manager->persist($category);
            $this->addReference('category-'.$i, $category);
            $i ++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
