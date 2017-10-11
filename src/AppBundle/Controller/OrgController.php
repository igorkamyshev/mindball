<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OrgController extends Controller
{
    /**
     * @Route("/org", name="org_homepage")
     */
    public function indexAction()
    {
        return $this->render('org/index.html.twig');
    }

    // TODO: real logics
    /**
     * @Route("/org/tournaments", name="org_tournaments")
     */
    public function tournamentsAction()
    {
        return $this->render('org/tournaments.html.twig');
    }

    /**
     * @Route("/org/adverts", name="org_adverts")
     */
    public function advertsAction()
    {
        // TODO: add adverts from season
        /** @var User $user */
        $user = $this->getUser();

        return $this->render(
            'org/adverts.html.twig',
            [
                'adverts' => $user->getAdverts(),
            ]
        );
    }
}