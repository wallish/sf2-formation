<?php

namespace ESGI\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity
 */
class Comment
{
    /**
    * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
    * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
    */
    protected $post;
    
    /**
    * @ORM\ManyToOne(targetEntity="ESGI\UserBundle\Entity\User")
    * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
    */
    private $author;

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
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isPublished", type="boolean")
     */
    private $isPublished;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Comment
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set isPublished
     *
     * @param boolean $isPublished
     * @return Comment
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Get isPublished
     *
     * @return boolean 
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * Set post
     *
     * @param \ESGI\BlogBundle\Entity\Post $post
     * @return Comment
     */
    public function setPost(\ESGI\BlogBundle\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \ESGI\BlogBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set author
     *
     * @param \ESGI\UserBundle\Entity\User $author
     * @return Comment
     */
    public function setAuthor(\ESGI\UserBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \ESGI\UserBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
