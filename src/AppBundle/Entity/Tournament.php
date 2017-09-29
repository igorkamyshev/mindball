<?php

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Tournament
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="tournaments")
 * @ORM\Entity
 */
class Tournament
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
     * @var Area
     *
     * @ORM\ManyToOne(targetEntity="Area", inversedBy="tournaments")
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id")
     */
    private $area;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="TournamentSeason", mappedBy="tournament")
     */
    private $seasons;

    /**
     * @var boolean
     *
     * @ORM\Column(name="unlimited_license", type="boolean")
     */
    private $unlimitedLicense = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="available_licenses", type="integer")
     */
    private $availableLicenses;


    public function __construct()
    {
        $this->seasons = new ArrayCollection();
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

    public function setTitle(string $title): Tournament
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Area
     */
    public function getArea()
    {
        return $this->area;
    }

    public function setArea(Area $area): Tournament
    {
        $this->area = $area;

        return $this;
    }

    public function getSeasons(): Collection
    {
        return $this->seasons;
    }

    public function addSeason(TournamentSeason $season): Tournament
    {
        $this->seasons->add($season);

        return $this;
    }

    public function removeSeason(TournamentSeason $season): Tournament
    {
        $this->seasons->removeElement($season);

        return $this;
    }

    public function clearSeasons() : Tournament
    {
        $this->seasons->clear();

        return $this;
    }

    public function isUnlimitedLicense(): bool
    {
        return $this->unlimitedLicense;
    }

    public function setUnlimitedLicense(bool $unlimitedLicense): Tournament
    {
        $this->unlimitedLicense = $unlimitedLicense;

        return $this;
    }

    /**
     * @return int
     */
    public function getAvailableLicenses()
    {
        return $this->availableLicenses;
    }

    public function setAvailableLicenses(int $availableLicenses): Tournament
    {
        $this->availableLicenses = $availableLicenses;

        return $this;
    }

    public function getSeasonsCount() : int
    {
        return $this->seasons->count();
    }

    public function getPastSeasons() : Collection
    {
        return $this->seasons->filter(
            function (TournamentSeason $season) {
                return $season->getEndDate() < (new \DateTime());
        });
    }

    public function __toString() : string
    {
        return $this->getTitle() . ' (' . $this->getArea() . ')';
    }
}