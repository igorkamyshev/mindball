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
    const LEVELS = [
        0 => 'Высшая',
        1 => 'Первая',
        2 => 'Вторая',
    ];

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

    public function setTitle(string $title): TournamentLeague
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    public function setLevel(int $level): TournamentLeague
    {
        $this->level = $level;

        return $this;
    }

    public function getLevelName()
    {
        return self::LEVELS[$this->level];
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description): TournamentLeague
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return TournamentSeason
     */
    public function getSeason()
    {
        return $this->season;
    }

    public function setSeason(TournamentSeason $season): TournamentLeague
    {
        $this->season = $season;

        return $this;
    }
}