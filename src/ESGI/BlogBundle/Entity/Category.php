<?php

namespace ESGI\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category.
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
{
    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="category")
     */
    protected $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * Get id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add posts.
     *
     * @param \ESGI\BlogBundle\Entity\Post $posts
     *
     * @return Category
     */
    public function addPost(\ESGI\BlogBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts.
     *
     * @param \ESGI\BlogBundle\Entity\Post $posts
     */
    public function removePost(\ESGI\BlogBundle\Entity\Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
