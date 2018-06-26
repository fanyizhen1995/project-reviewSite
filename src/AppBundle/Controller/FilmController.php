<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class FilmController extends Controller
{
    /**
     * @Route("/filmList", name="film_list")
     */
    public function showFilmAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user == 'anon.') {
            $userPseudo = "visitor";
        } else {
            $userPseudo = $user->getPseudo();
        }

        $em = $this->get('doctrine')->getManager();
        $candidatures = $em->getRepository('AppBundle:Candidature')->findAll();

        $allFilms = $em->createQuery(
            "SELECT 
                f
             FROM AppBundle:CandidatureNote f 
             ORDER BY f.noteAvg DESC "
        )->getResult();
        $bestFilms = array();

        if (sizeof($allFilms) >=3) {
            for($i=0;$i<3;$i++){
                $bestFilms[] = $allFilms[$i];
            }
        } else {
            for($i=0;$i<sizeof($allFilms);$i++){
                $bestFilms[] = $allFilms[$i];
            }
        }


        return $this->render('film/show_film.html.twig', array(
            'candidatures'  => $candidatures,
            'username'      => $userPseudo,
            'bestFilms'      => $bestFilms
        ));
    }
    /**
     * @Route("/filmList/{fid}", name="one_film")
     */
    public function showOneFilmAction($fid)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user == 'anon.') {
            $userPseudo = "visitor";
        } else {
            $userPseudo = $user->getPseudo();
        }

        $em = $this->get('doctrine')->getManager();
        $film = $em->getRepository('AppBundle:Candidature')->findOneById($fid);

        $images = $em->getRepository('AppBundle:Image')->findBy(
            array(
                'isPoster'      => false,
                'candidature'   => $film
            )
        );
        $candidatureNote = $em->getRepository('AppBundle:CandidatureNote')->findOneByCandidature($film);

        return $this->render('film/one_film.html.twig', array(
            'images'    =>  $images,
            'film'  => $film,
            'statistic' => $candidatureNote,
            'username'  => $userPseudo
        ));
    }

}