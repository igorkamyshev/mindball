<?php

namespace AppBundle\Controller;


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
}