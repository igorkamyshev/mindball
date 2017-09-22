<?php

namespace AppBundle\Entity;


use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Tournament League
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="tournament_leagues")
 * @ORM\Entity
 */
class TournamentLeague
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
     * @var integer
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var TournamentSeason
     *
     * @ORM\ManyToOne(targetEntity="TournamentSeason", inversedBy="leagues")
     * @ORM\JoinColumn(name="season_id", referencedColumnName="id")
     */
    private $season;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): TournamentLeague
    {
        $this->title = $title;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): TournamentLeague
    {
        $this->level = $level;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): TournamentLeague
    {
        $this->description = $description;

        return $this;
    }

    public function getSeason(): ?TournamentSeason
    {
        return $this->season;
    }

    public function setSeason(TournamentSeason $season): TournamentLeague
    {
        $this->season = $season;

        return $this;
    }
}