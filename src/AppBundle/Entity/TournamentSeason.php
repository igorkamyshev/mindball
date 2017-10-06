<?php

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Tournament Season
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="tournament_seasons")
 * @ORM\Entity
 */
class TournamentSeason
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
     * @ORM\Column(name="year", type="integer", nullable=false)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var Tournament
     *
     * @ORM\ManyToOne(targetEntity="Tournament", inversedBy="seasons")
     * @ORM\JoinColumn(name="tournament_id", referencedColumnName="id")
     */
    private $tournament;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="TournamentLeague", mappedBy="season", cascade={"persist"})
     */
    private $leagues;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="qualifying_round_start_date", type="datetime", nullable=true)
     */
    private $qualifyingRoundStartDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="qualifying_round_end_date", type="datetime", nullable=true)
     */
    private $qualifyingRoundEndDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    private $endDate;


    public function __construct()
    {
        $this->leagues = new ArrayCollection();

        $this->qualifyingRoundStartDate = new \DateTime();
        $this->qualifyingRoundEndDate = new \DateTime();
        $this->startDate = new \DateTime();
        $this->endDate = new \DateTime();
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

    public function setTitle(string $title): TournamentSeason
    {
        $this->title = $title;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): TournamentSeason
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress(string $address): TournamentSeason
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Tournament
     */
    public function getTournament()
    {
        return $this->tournament;
    }

    public function setTournament(Tournament $tournament): TournamentSeason
    {
        $this->tournament = $tournament;

        return $this;
    }

    public function getLeagues() : Collection
    {
        return $this->leagues;
    }

    public function addLeague(TournamentLeague $league) : TournamentSeason
    {
        $this->leagues->add($league);

        return $this;
    }

    public function removeLeague(TournamentLeague $league) : TournamentSeason
    {
        $this->leagues->removeElement($league);

        return $this;
    }

    public function clearLeagues() : TournamentSeason
    {
        $this->leagues->clear();

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getQualifyingRoundStartDate()
    {
        return $this->qualifyingRoundStartDate;
    }

    public function setQualifyingRoundStartDate($qualifyingRoundStartDate): TournamentSeason
    {
        $this->qualifyingRoundStartDate = $qualifyingRoundStartDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getQualifyingRoundEndDate()
    {
        return $this->qualifyingRoundEndDate;
    }

    public function setQualifyingRoundEndDate($qualifyingRoundEndDate): TournamentSeason
    {
        $this->qualifyingRoundEndDate = $qualifyingRoundEndDate;

        return $this;
    }

    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    public function setStartDate($startDate): TournamentSeason
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    public function setEndDate($endDate): TournamentSeason
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function __toString() : string
    {
        return $this->getTitle() . ' – ' . $this->getTournament();
    }
}