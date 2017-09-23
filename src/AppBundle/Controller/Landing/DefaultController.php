<?php

namespace AppBundle\Controller\Landing;

use AppBundle\Entity\Advert;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    const LAST_ADVERTS_LIMIT = 4;

    /**
     * @Route("/", name = "homepage")
     */
    public function indexAction()
    {
        $adverts = $this
            ->getDoctrine()
            ->getRepository(Advert::class)
            ->findBy([], ['createdAt' => 'DESC'], self::LAST_ADVERTS_LIMIT);

        return $this->render(
            'landing/index.html.twig',
            [
                'adverts' => $adverts,
            ]
        );
    }

    /**
     * @Route("/adverts", name = "adverts")
     */
    public function advertsAction()
    {
        // TODO: Pagination
        $adverts = $this
            ->getDoctrine()
            ->getRepository(Advert::class)
            ->findBy([], ['createdAt' => 'DESC'], self::LAST_ADVERTS_LIMIT);

        return $this->render(
            'landing/adverts.html.twig',
            [
                'adverts' => $adverts,
            ]
        );
    }

    /**
     * @Route("/adverts/{slug}", name = "advert")
     * @ParamConverter("advert", options={"mapping": {"slug": "slug"}})
     */
    public function advertAction(Advert $advert)
    {
        return $this->render(
            'landing/advert.html.twig',
            [
                'advert' => $advert,
            ]
        );
    }
}
