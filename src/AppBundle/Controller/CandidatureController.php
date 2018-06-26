<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Candidature;
use AppBundle\Entity\CandidatureNote;
use AppBundle\Entity\Image;
use AppBundle\Form\Type\CandidatureCreateType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CandidatureController extends Controller
{
    /**
     * @Route("/createCandidature", name="create_candidature")
     */
    public function createCandidatureAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user == 'anon.') {
            $userPseudo = "visitor";
            return $this->redirectToRoute('login');
        } else {
            $userPseudo = $user->getPseudo();
        }
        $candidature = new Candidature();
        $form = $this->createForm(CandidatureCreateType::class, $candidature);
        $form->handleRequest($request);

        $em = $this->get('doctrine')->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $poster = $form->get('poster')->getData();
            $otherImages = $form->get('other_photos')->getData();
            $candidature = $form->getData();
            $candidatureNote = new CandidatureNote();
            $candidatureNote->setCandidature($candidature);
            $candidatureNote->setNoteGlobal(0);
            $candidatureNote->setNoteNumber(0);
            $candidatureNote->setNoteAvg(0);
            $candidatureNote->setNoteNb1(0);
            $candidatureNote->setNoteNb2(0);
            $candidatureNote->setNoteNb3(0);
            $candidatureNote->setNoteNb4(0);
            $candidatureNote->setNoteNb5(0);

            $em->persist($candidature);
            $em->persist($candidatureNote);

            $posterName = $candidature->getTitle() . '_Poster.jpg';
            $poster->move($this->getParameter('film_images_directory').'/'.$candidature->getTitle(), $posterName);
            $posterPath = $this->getParameter('film_images_directory').'/'.$candidature->getTitle().'/'.$posterName;

            $imagePoster = new Image();
            $imagePoster->setCandidature($candidature);
            $imagePoster->setIsPoster(true);
            $imagePoster->setUrl($posterPath);

            $em->persist($imagePoster);

            foreach ($otherImages as $key => $otherImage){
                $otherImageName = $candidature->getTitle() . '_'.$key.'.jpg';
                $otherImage->move($this->getParameter('film_images_directory').'/'.$candidature->getTitle(), $otherImageName);
                $otherImagePath = $this->getParameter('film_images_directory').'/'.$candidature->getTitle().'/'.$otherImageName;

                $image[$key] = new Image();
                $image[$key]->setCandidature($candidature);
                $image[$key]->setIsPoster(false);
                $image[$key]->setUrl($otherImagePath);
                $em->persist($image[$key]);

            }

            $em->flush();

            return $this->redirectToRoute('film_list');
        }

        return $this->render('basic/create_candidature.html.twig', array(
            'form'  => $form->createView(),
            'username'  => $userPseudo

        ));
    }
}