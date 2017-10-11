<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Advert;
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
        $repo = $this->getDoctrine()->getRepository(Advert::class);

        // TODO: replace by adverts from season
        $filters = [];
        $filters['author'] = $this->getUser();

        return $this->render(
            'org/adverts.html.twig',
            [
                'userAdverts' => $repo->findFilteredByPage($filters),
            ]
        );
    }

    /**
     * @Route("/org/advert/delete/{slug}", name="org_advert_delete")
     * @ParamConverter("advert", options={"mapping": {"slug": "slug"}})
     */
    public function deleteAdvertAction(Advert $advert)
    {
        $em = $this->getDoctrine()->getManager();

        // TODO: replace by check for season
        if ($advert->getAuthor()->getId() != $this->getUser()->getId()) {
            return $this->createAccessDeniedException();
        }

        $em->remove($advert);
        $em->flush();

        return $this->render(
            'org/info.html.twig',
            [
                'message' => 'Объявление "' . $advert->getTitle() . '" удалено.',
            ]
        );
    }
}