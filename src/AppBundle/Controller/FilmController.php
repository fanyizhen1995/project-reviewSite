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

        return $this->render('film/show_film.html.twig', array(
            // ...
        ));
    }
    /**
     * @Route("/filmList/{fid}", name="one_film")
     */
    public function showOneFilmAction($fid)
    {

        return $this->render('film/show_film.html.twig', array(
            // ...
        ));
    }

}