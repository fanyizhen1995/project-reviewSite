<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\VoteCreateType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Vote;

class VoteController extends Controller
{
    /**
     * @Route("/createVote", name="create_vote")
     */
    public function createVoteAction(Request $request)
    {
        $vote = new Vote();
        $form = $this->createForm(VoteCreateType::class, $vote);
        $form->handleRequest($request);

        $em = $this->get('doctrine')->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $vote = $form->getData();
            $em->persist($vote);
            $em->flush();
            return $this->redirectToRoute('vote_list');

        }



        return $this->render('vote/create_vote.html.twig', array(
            'form'  => $form->createView()
        ));
    }

    /**
     * @Route("/voteList", name="vote_list")
     */
    public function showVoteAction()
    {
        $em = $this->get('doctrine')->getManager();
        $votes = $em->getRepository('AppBundle:Vote')->findAll();
        return $this->render('vote/show_vote.html.twig', array(
            'votes'     => $votes
        ));
    }

    /**
     * @Route("/voteList/{vid}", name="one_vote")
     */
    public function showOneVoteAction($vid)
    {

        return $this->render('vote/one_vote.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/myVoteList", name="my_vote_info")
     */
    public function showMyVoteAction()
    {

        return $this->render('vote/my_vote_info.html.twig', array(
            // ...
        ));
    }

}