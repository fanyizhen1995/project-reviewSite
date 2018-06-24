<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VoteCandidature
 *
 * @ORM\Table(name="vote_candidature")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VoteCandidatureRepository")
 */
class VoteCandidature
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Vote")
     * @ORM\JoinColumn(name="vote", referencedColumnName="id", onDelete="CASCADE")
     */
    private $vote;

    /**
     * @ORM\ManyToOne(targetEntity="Candidature")
     * @ORM\JoinColumn(name="candidature", referencedColumnName="id", onDelete="CASCADE")
     */
    private $candidature;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * GETTER
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * @return mixed
     */
    public function getCandidature()
    {
        return $this->candidature;
    }

    /**
     * @param mixed $candidature
     */
    public function setCandidature($candidature)
    {
        $this->candidature = $candidature;
    }

    /**
     * @param mixed $vote
     */
    public function setVote($vote)
    {
        $this->vote = $vote;
    }
}
