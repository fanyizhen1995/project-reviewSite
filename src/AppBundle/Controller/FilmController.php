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


        return $this->render('film/show_film.html.twig', array(
            'candidatures'  => $candidatures,
            'username'      => $userPseudo,
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

        return $this->render('film/one_film.html.twig', array(
            'images'    =>  $images,
            'film'  => $film,
            'username'  => $userPseudo
        ));
    }

}