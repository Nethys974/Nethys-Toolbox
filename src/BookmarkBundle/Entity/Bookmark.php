<?php

namespace BookmarkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use MainBundle\Entity\Timestamp;

/**
 * Bookmark
 *
 * @ORM\Table(name="bookmark_list")
 * @ORM\Entity(repositoryClass="BookmarkBundle\Repository\BookmarkRepository")
 */
class Bookmark extends Timestamp
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     * @Assert\Url(
     *    message = "L'url '{{ value }}' n'est pas valide",
     * )
     */
    private $url;

    /**
     * @var int
     *
     * @ORM\Column(name="mark", type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 5,
     *      minMessage = "La note ne peut pas être inférieure à {{ limit }}",
     *      maxMessage = "La note ne peut pas être supérieure à {{ limit }}"
     * )
     */
    private $mark = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="string", length=255, nullable=true)
     */
    private $tags;

    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=255, nullable=true)
     */
    private $icon;

    /**
     * @var string
     *
     * @ORM\Column(name="page_capture", type="string", length=255, nullable=true)
     */
    private $pageCapture;
    
    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=255, nullable=true)
     */
    private $note;


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
     * Set title
     *
     * @param string $title
     * @return Bookmark
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Bookmark
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set mark
     *
     * @param integer $mark
     * @return Bookmark
     */
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Get mark
     *
     * @return integer 
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set tags
     *
     * @param string $tags
     * @return Bookmark
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set icon
     *
     * @param string $icon
     * @return Bookmark
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string 
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set pageCapture
     *
     * @param string $pageCapture
     * @return Bookmark
     */
    public function setPageCapture($pageCapture)
    {
        $this->pageCapture = $pageCapture;

        return $this;
    }

    /**
     * Get pageCapture
     *
     * @return string 
     */
    public function getPageCapture()
    {
        return $this->pageCapture;
    }
    
    /**
     * Set note
     *
     * @param string $note
     * @return Bookmark
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }
}
