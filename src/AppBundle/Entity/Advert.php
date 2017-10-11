<?php

namespace AppBundle\Entity;


use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Advert
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="adverts")
 * @ORM\Entity
 */
class Advert
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", type="string", length=128, nullable=false, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="intro", type="string", length=255, nullable=true)
     */
    private $intro;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    private $body;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=false)
     */
    private $priority = 4;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="adverts")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @var TournamentSeason
     *
     * @ORM\ManyToOne(targetEntity="TournamentSeason", inversedBy="adverts")
     * @ORM\JoinColumn(name="season_id", referencedColumnName="id")
     */
    private $season;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title): Advert
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
    }

    public function setIntro(string $intro): Advert
    {
        $this->intro = $intro;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    public function setBody(string $body): Advert
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    public function setPriority(int $priority): Advert
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): Advert
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor(User $author): Advert
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return TournamentSeason
     */
    public function getSeason()
    {
        return $this->season;
    }

    public function setSeason(TournamentSeason $season): Advert
    {
        $this->season = $season;

        return $this;
    }

    public function __toString() : string
    {
        return $this->title;
    }
}