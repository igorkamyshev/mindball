<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class Review
 * @package AppBundle\Review
 *
 * @ORM\Table(name="reviews")
 * @ORM\Entity
 */
class Review
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
     * @ORM\Column(name="body", type="text", nullable=false)
     */
    private $body;

    /**
     * @var TournamentSeason
     *
     * @ORM\ManyToOne(targetEntity="TournamentSeason")
     * @ORM\JoinColumn(name="tournament_season_id", referencedColumnName="id")
     */
    private $tournamentSeason;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="approved", type="boolean")
     */
    private $approved = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): Review
    {
        $this->body = $body;

        return $this;
    }

    public function getTournamentSeason(): ?TournamentSeason
    {
        return $this->tournamentSeason;
    }

    public function setTournamentSeason(TournamentSeason $tournamentSeason): Review
    {
        $this->tournamentSeason = $tournamentSeason;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): Review
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return bool
     */
    public function isApproved(): bool
    {
        return $this->approved;
    }

    public function setApproved(bool $approved): Review
    {
        $this->approved = $approved;

        return $this;
    }
}