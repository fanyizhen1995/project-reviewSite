<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class VoteController extends Controller
{
    /**
     * @Route("/createVote", name="create_vote")
     */
    public function createVoteAction()
    {

        return $this->render('vote/create_vote.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/voteList", name="vote_list")
     */
    public function showVoteAction()
    {

        return $this->render('vote/show_vote.html.twig', array(
            // ...
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