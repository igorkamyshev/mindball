<?php

namespace AppBundle\Services\Listeners;


use AppBundle\Entity\Area;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class TournamentsInjector
{
    protected $twig;
    protected $em;

    public function __construct(EntityManager $entityManager, \Twig_Environment $twig)
    {
        $this->twig = $twig;
        $this->em = $entityManager;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $areas = array_filter(
            $this->em->getRepository(Area::class)->findAll(),
            function (Area $area) {
                return $area->hasActiveTournaments();
            }
        );

        $this->twig->addGlobal('areas', $areas);
    }
}