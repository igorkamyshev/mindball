<?php

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Area
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="areas")
 * @ORM\Entity
 */
class Area
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
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Tournament", mappedBy="area")
     */
    private $tournaments;

    public function __construct()
    {
        $this->tournaments = new ArrayCollection();
    }

    public function getId() : ?int
    {
        return $this->id;
    }

    public function getSlug() : ?string
    {
        return $this->slug;
    }

    public function getTitle() : ?string
    {
        return $this->title;
    }

    public function setTitle(string $title) : Area
    {
        $this->title = $title;

        return $this;
    }

    public function getTournaments() : Collection
    {
        return $this->tournaments;
    }

    public function addTournament(Tournament $tournament) : Area
    {
        $this->tournaments->add($tournament);

        return $this;
    }

    public function removeTournament(Tournament $tournament) : Area
    {
        $this->tournaments->removeElement($tournament);

        return $this;
    }

    public function clearTournaments() : Area
    {
        $this->tournaments->clear();

        return $this;
    }

    public function __toString() : string
    {
        return $this->getTitle();
    }
}