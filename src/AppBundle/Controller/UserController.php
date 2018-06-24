<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use AppBundle\Form\Type\UserCreateType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user == 'anon.') {
            $userPseudo = "visitor";
        } else {
            $userPseudo = $user->getPseudo();
        }
        $client = new Client();
        $form = $this->createForm(UserCreateType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $client = $form->getData();
            $password = $this->get('security.password_encoder')->encodePassword($client, $client->getPassword());
            $client->setPassword($password);
            $em = $this->get('doctrine')->getManager();

            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('login');
        }
        return $this->render('user/register.html.twig', array(
            'form'  => $form->createView(),
            'username'  => $userPseudo
        ));
    }

    /**
     * @Route("/userList", name="user_list")
     */
    public function showUserListAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user == 'anon.') {
            $userPseudo = "visitor";
        } else {
            $userPseudo = $user->getPseudo();
        }
        $em = $this->get('doctrine')->getManager();
        $clients = $em->getRepository('AppBundle:Client')->findAll();

        return $this->render('user/user_list.html.twig', array(
            'clients'   => $clients,
            'username'  => $userPseudo
        ));
    }

    /**
     * @Route("/user/{uid}", name="one_user_info")
     */
    public function showProfileAction($uid)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user == 'anon.') {
            $userPseudo = "visitor";
        } else {
            $userPseudo = $user->getPseudo();
        }
        $em = $this->get('doctrine')->getManager();
        $client = $em->getRepository('AppBundle:Client')->findOneById($uid);


        return $this->render('user/one_user.html.twig', array(
            'client'   => $client,
            'username'  => $userPseudo
        ));
    }

}