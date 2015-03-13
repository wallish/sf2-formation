<?php
namespace ESGI\BlogBundle\DataFixtures\ORM;

use ESGI\BlogBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;

class CommentFixtures extends  AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        $i = 1;
        while ($i <= 100) {
            $comment = new Comment();
            $comment->setText($faker->realText($maxNbChars = 100, $indexSize = 2));

            $rand = rand(1, 20);
            $comment->setAuthor($this->getReference('user-'.$rand));

            $comment->setIsPublished($i%2);

            $rand = rand(1, 100);
            $comment->setPost($this->getReference('post-'.$rand));

            $manager->persist($comment);

            $i ++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
