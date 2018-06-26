<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ClientVote;
use AppBundle\Entity\Note;
use AppBundle\Entity\VoteCandidature;
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
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user == 'anon.') {
            $userPseudo = "visitor";
            return $this->redirectToRoute('login');
        } else {
            $userPseudo = $user->getPseudo();
        }

        $vote = new Vote();
        $form = $this->createForm(VoteCreateType::class, $vote);
        $form->handleRequest($request);

        $em = $this->get('doctrine')->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $dtz = new \DateTimeZone("Europe/Paris");
            $now = new \DateTime(date("Y-m-d"), $dtz);
            $now->format("Y-m-d");
            $vote = $form->getData();
            $em->persist($vote);
            $films = $form->get('introduction')->getData();
            foreach ($films as $key => $film) {
                $filmVote[$key] = new VoteCandidature();
                $filmVote[$key]->setVote($vote);
                $filmVote[$key]->setCandidature($film);
                $filmVote[$key]->setNoteGlobal(0);
                $filmVote[$key]->setNoteNumber(0);
                $filmVote[$key]->setNoteAvg(0);
                $filmVote[$key]->setNoteNb1(0);
                $filmVote[$key]->setNoteNb2(0);
                $filmVote[$key]->setNoteNb3(0);
                $filmVote[$key]->setNoteNb4(0);
                $filmVote[$key]->setNoteNb5(0);

                $em->persist($filmVote[$key]);


            }
            $ClientVote = new ClientVote();
            $ClientVote->setClient($user);
            $ClientVote->setIsCreator(true);
            $ClientVote->setIsParticipant(false);
            $ClientVote->setVote($vote);
            $ClientVote->setCreationDate($now);
            $em->persist($ClientVote);
            $em->flush();
            return $this->redirectToRoute('vote_list');

        }



        return $this->render('vote/create_vote.html.twig', array(
            'form'  => $form->createView(),
            'username'  => $userPseudo

        ));
    }

    /**
     * @Route("/voteList", name="vote_list")
     */
    public function showVoteAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user == 'anon.') {
            $userPseudo = "visitor";
        } else {
            $userPseudo = $user->getPseudo();
        }

        $em = $this->get('doctrine')->getManager();
        $votes = $em->getRepository('AppBundle:Vote')->findAll();
        return $this->render('vote/show_vote.html.twig', array(
            'votes'     => $votes,
            'username'  => $userPseudo
        ));
    }

    /**
     * @Route("/voteList/{vid}", name="one_vote")
     */
    public function showOneVoteAction($vid, Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user == 'anon.') {
            $userPseudo = "visitor";
            return $this->redirectToRoute('login');
        } else {
            $userPseudo = $user->getPseudo();
        }

        $em = $this->get('doctrine')->getManager();
        $vote = $em->getRepository('AppBundle:Vote')->findOneById($vid);
        $voteCandidatures = $em->getRepository('AppBundle:VoteCandidature')->findByVote($vote);
        foreach ($voteCandidatures as $key => $voteCandidature) {
            $candidatures[$key] = $voteCandidature->getCandidature();
        }
        $isParticipantYet = $em->getRepository('AppBundle:ClientVote')
            ->findOneBy(
                array(
                    'client'    => $user,
                    'isParticipant' => true,
                )
            );
        if ($isParticipantYet == null) {

            if (isset($_POST['submitNote'])) {
                $dtz = new \DateTimeZone("Europe/Paris");
                $now = new \DateTime(date("Y-m-d"), $dtz);
                $now->format("Y-m-d");
                $noteFilm = $_POST["select"];
                foreach ($candidatures as $key => $candidature) {
                    $note[$key] = new Note();
                    $note[$key]->setVote($vote);
                    $note[$key]->setCandidature($candidature);
                    $note[$key]->setNote($noteFilm[$key]);
                    $note[$key]->setClient($user);
                    $em->persist($note[$key]);

                    $candidatureNote = $em->getRepository('AppBundle:CandidatureNote')->findOneByCandidature($candidature);
                    $noteNb = $candidatureNote->getNoteNumber();
                    $noteGlobal = $candidatureNote->getNoteGlobal();

                    $candidatureNote->setNoteGlobal($noteGlobal+$noteFilm[$key]);
                    $candidatureNote->setNoteNumber($noteNb+1);
                    $candidatureNote->setNoteAvg(($noteGlobal+$noteFilm[$key])/($noteNb+1));
                    switch ($noteFilm[$key]) {
                        case 1 :
                            $note1 = $candidatureNote->getNoteNb1();
                            $candidatureNote->setNoteNb1($note1+1);
                            break;
                        case 2 :
                            $note1 = $candidatureNote->getNoteNb2();
                            $candidatureNote->setNoteNb2($note1+1);
                            break;
                        case 3 :
                            $note1 = $candidatureNote->getNoteNb3();
                            $candidatureNote->setNoteNb3($note1+1);
                            break;
                        case 4 :
                            $note1 = $candidatureNote->getNoteNb4();
                            $candidatureNote->setNoteNb4($note1+1);
                            break;
                        case 5 :
                            $note1 = $candidatureNote->getNoteNb5();
                            $candidatureNote->setNoteNb5($note1+1);
                            break;

                    }

                    $voteCandidature = $em->getRepository('AppBundle:VoteCandidature')->findOneBy(
                        array(
                            'vote'          => $vote,
                            'candidature'   => $candidature,
                        )
                    );

                    $voteNoteNb = $voteCandidature->getNoteNumber();
                    $voteNoteGlobal = $voteCandidature->getNoteGlobal();

                    $voteCandidature->setNoteGlobal($voteNoteGlobal+$noteFilm[$key]);
                    $voteCandidature->setNoteNumber($voteNoteNb+1);
                    $voteCandidature->setNoteAvg(($voteNoteGlobal+$noteFilm[$key])/($voteNoteNb+1));

                    switch ($noteFilm[$key]) {
                        case 1 :
                            $note1 = $voteCandidature->getNoteNb1();
                            $voteCandidature->setNoteNb1($note1+1);
                            break;
                        case 2 :
                            $note1 = $voteCandidature->getNoteNb2();
                            $voteCandidature->setNoteNb2($note1+1);
                            break;
                        case 3 :
                            $note1 = $voteCandidature->getNoteNb3();
                            $voteCandidature->setNoteNb3($note1+1);
                            break;
                        case 4 :
                            $note1 = $voteCandidature->getNoteNb4();
                            $voteCandidature->setNoteNb4($note1+1);
                            break;
                        case 5 :
                            $note1 = $voteCandidature->getNoteNb5();
                            $voteCandidature->setNoteNb5($note1+1);
                            break;

                    }
                }
                $isCreator = $em->getRepository('AppBundle:ClientVote')
                    ->findOneBy(
                        array(
                            'client' => $user,
                            'isCreator' => true,
                        )
                    );
                if ($isCreator == null) {
                    $ClientVote = new ClientVote();
                    $ClientVote->setClient($user);
                    $ClientVote->setIsCreator(false);
                    $ClientVote->setIsParticipant(true);
                    $ClientVote->setVote($vote);
                    $ClientVote->setCreationDate($now);
                    $em->persist($ClientVote);
                } else {
                    $isCreator->setIsParticipant(true);
                }
                $em->flush();

                return $this->redirectToRoute('vote_list');
            }
        } else {
            return $this->redirectToRoute('one_my_vote',array('vid' => $vid));
        }


        return $this->render('vote/one_vote.html.twig', array(
            'vote'  => $vote,
            'candidatures'  => $candidatures,
            'username'  => $userPseudo
        ));
    }

    /**
     * @Route("/myVoteList", name="my_vote_info")
     */
    public function showMyVoteAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user == 'anon.') {
            $userPseudo = "visitor";
            return $this->redirectToRoute('login');
        } else {
            $userPseudo = $user->getPseudo();
        }
        $em = $this->get('doctrine')->getManager();
        $votes = $em->getRepository('AppBundle:ClientVote')->findByClient($user);

        if ($votes != null) {
            foreach ($votes as $key => $vote) {
                $exactVotes[$key] = $vote->getVote();
            }
        }

        return $this->render('vote/my_vote_info.html.twig', array(
            'username'  => $userPseudo,
            'votes'     => $exactVotes,

        ));
    }

    /**
     * @Route("/myVoteList/{vid}", name="one_my_vote")
     */
    public function showOneMyVoteAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user == 'anon.') {
            $userPseudo = "visitor";
            return $this->redirectToRoute('login');
        } else {
            $userPseudo = $user->getPseudo();
        }

        return $this->render('vote/one_my_vote.html.twig', array(
            'username'  => $userPseudo
        ));
    }

}