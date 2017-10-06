<?php

namespace AppBundle\Services\Listeners;


use AppBundle\Entity\Area;
use AppBundle\Entity\PartnerPage;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class PartnerPagesInjector
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
        $pages = $this->em->getRepository(PartnerPage::class)->findAll();

        $this->twig->addGlobal('partnerPages', $pages);
    }
}