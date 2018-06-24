<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user == 'anon.') {
            $userPseudo = "visitor";
        } else {
            $userPseudo = $user->getPseudo();
        }

        if ($request->getMethod() == 'POST') {
            $username = $_POST['_username'];
            $password = $_POST['_password'];
            $em = $this->getDoctrine();
            $repo = $em->getRepository("AppBundle:Client");
            $user = $repo->findOneByUsername($username);
            $encoded = $this->get('security.password_encoder')->encodePassword($user, $password);

            if (!$user) {
                return $this->render(
                    'basic/login.html.twig',
                    array(
                        'last_username' => $username,
                        'error' => 'username or password is not correct',
                        'username'  => $userPseudo
                    )
                );
            }
            else {
                if ($this->get('security.password_encoder')->isPasswordValid($user, $password)) {
                    $token = new UsernamePasswordToken($user, $password, 'main', $user->getRoles());
                    $this->get('security.token_storage')->setToken($token);
                    $this->get('session')->set('_security_main', serialize($token));
                    return $this->redirectToRoute('film_list');
                } else {
                    return $this->render(
                        'basic/login.html.twig',
                        array(
                            'last_username' => $username,
                            'error'         => 'password is not correct',
                            'username'  => $userPseudo
                        )
                    );
                }
            }
        }

        elseif($request->getMethod() == 'GET') {
            return $this->render('basic/login.html.twig',
                array(
                    'username'  => $userPseudo
                ));
        }
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function indexAction()
    {
        return $this->redirectToRoute('login');
    }

}
