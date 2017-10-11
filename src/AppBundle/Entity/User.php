<?php

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Advert", mappedBy="author")
     */
    protected $adverts;

    public function __construct()
    {
        parent::__construct();

        $this->adverts = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id): User
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getAdverts(): Collection
    {
        return $this->adverts;
    }

    public function addAdvert(Advert $advert): User
    {
        $this->adverts->add($advert);

        return $this;
    }

    public function removeAdvert(Advert $advert): User
    {
        $this->adverts->removeElement($advert);

        return $this;
    }

    public function clearAdverts() : User
    {
        $this->adverts->clear();

        return $this;
    }
}