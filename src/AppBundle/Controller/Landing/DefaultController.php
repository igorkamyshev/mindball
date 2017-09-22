<?php

namespace AppBundle\Controller\Landing;

use AppBundle\Entity\Advert;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    const LAST_ADVERTS_LIMIT = 4;

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $adverts = $this
            ->getDoctrine()
            ->getRepository(Advert::class)
            ->findBy([], ['createdAt' => 'ASC'], self::LAST_ADVERTS_LIMIT);

        return $this->render(
            'landing/index.html.twig',
            [
                'adverts' => $adverts,
            ]
        );
    }
}
