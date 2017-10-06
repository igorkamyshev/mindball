<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Advert;
use AppBundle\Entity\Info;
use AppBundle\Entity\Review;
use AppBundle\Entity\Tournament;
use AppBundle\Entity\TournamentSeason;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LandingController extends Controller
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
            ->findBy([], ['createdAt' => 'DESC'], self::LAST_ADVERTS_LIMIT);

        $infoCards = $this
            ->getDoctrine()
            ->getRepository(Info::class)
            ->findBy(['published' => true], ['priority' => 'DESC']);

        return $this->render(
            'landing/index.html.twig',
            [
                'adverts'   => $adverts,
                'infoCards' => $infoCards,
            ]
        );
    }

    /**
     * @Route("/adverts", name="adverts")
     */
    public function advertsAction()
    {
        // TODO: Pagination
        $adverts = $this
            ->getDoctrine()
            ->getRepository(Advert::class)
            ->findBy([], ['createdAt' => 'DESC']);

        return $this->render(
            'landing/adverts.html.twig',
            [
                'adverts' => $adverts,
            ]
        );
    }

    /**
     * @Route("/adverts/{slug}", name="advert")
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

    /**
     * @Route("/reviews", name="reviews")
     */
    public function reviewsAction()
    {
        // TODO: Pagination
        $reviews = $this
            ->getDoctrine()
            ->getRepository(Review::class)
            ->findBy(
                ['approved' => true],
                ['createdAt' => 'DESC']
            );

        return $this->render(
            'landing/reviews.html.twig',
            [
                'reviews' => $reviews,
            ]
        );
    }

    /**
     * @Route("/albums", name="albums")
     */
    public function albumsAction()
    {
        // TODO: Pagination
        $tournaments = $this
            ->getDoctrine()
            ->getRepository(Tournament::class)
            ->findBy([], ['id' => 'DESC']);

        return $this->render(
            'landing/albums.html.twig',
            [
                'tournaments' => $tournaments,
            ]
        );
    }

    /**
     * @Route("/albums/{slug}", name="tournament_album")
     * @ParamConverter("tournament", options={"mapping": {"slug": "slug"}})
     */
    public function tournamentAlbumsAction(Tournament $tournament)
    {
        return $this->render(
            'landing/tournament_album.html.twig',
            [
                'tournament' => $tournament,
            ]
        );
    }

    /**
     * @Route("/albums/season/{slug}", name="season_album")
     * @ParamConverter("season", options={"mapping": {"slug": "slug"}})
     */
    public function seasonAlbumAction(TournamentSeason $season)
    {
        return $this->render(
            'landing/season_album.html.twig',
            [
                'season' => $season,
            ]
        );
    }

    /**
     * @Route("/tournament/{slug}", name="active_season")
     * @ParamConverter("season", options={"mapping": {"slug": "slug"}})
     */
    public function activeSeasonAction(TournamentSeason $season)
    {
        return $this->render(
            'landing/active_season.html.twig',
            [
                'season' => $season,
            ]
        );
    }
}
