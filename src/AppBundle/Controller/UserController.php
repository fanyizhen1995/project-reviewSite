<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    public function registerAction()
    {

        return $this->render('user/register.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/user/{uid}", name="one_user_info")
     */
    public function showProfileAction($uid)
    {

        return $this->render('user/one_user.html.twig', array(
            // ...
        ));
    }

}