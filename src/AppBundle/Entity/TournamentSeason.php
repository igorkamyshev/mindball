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
     * @ORM\Column(name="year", type="integer", length=63, nullable=false)
     */
    private $year;

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
    }


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

    public function getTournament(): ?Tournament
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

    public function getQualifyingRoundStartDate(): ?\DateTime
    {
        return $this->qualifyingRoundStartDate;
    }

    public function setQualifyingRoundStartDate(
        ?\DateTime $qualifyingRoundStartDate
    ): TournamentSeason
    {
        $this->qualifyingRoundStartDate = $qualifyingRoundStartDate;

        return $this;
    }

    public function getQualifyingRoundEndDate(): ?\DateTime
    {
        return $this->qualifyingRoundEndDate;
    }

    public function setQualifyingRoundEndDate(
        ?\DateTime $qualifyingRoundEndDate
    ): TournamentSeason
    {
        $this->qualifyingRoundEndDate = $qualifyingRoundEndDate;

        return $this;
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTime $startDate): TournamentSeason
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTime $endDate): TournamentSeason
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function __toString() : string
    {
        return $this->getTitle() . ' – ' . $this->getTournament();
    }
}