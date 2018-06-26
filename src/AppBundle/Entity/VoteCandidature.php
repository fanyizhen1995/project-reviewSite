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
     * @var int
     *
     * @ORM\Column(name="noteGlobal", type="integer")
     */
    private $noteGlobal;

    /**
     * @var int
     *
     * @ORM\Column(name="noteNumber", type="integer")
     */
    private $noteNumber;

    /**
     * @var float
     *
     * @ORM\Column(name="noteAvg", type="float")
     */
    private $noteAvg;

    /**
     * @var int
     *
     * @ORM\Column(name="noteNb5", type="integer")
     */
    private $noteNb5;

    /**
     * @var int
     *
     * @ORM\Column(name="noteNb4", type="integer")
     */
    private $noteNb4;

    /**
     * @var int
     *
     * @ORM\Column(name="noteNb3", type="integer")
     */
    private $noteNb3;

    /**
     * @var int
     *
     * @ORM\Column(name="noteNb2", type="integer")
     */
    private $noteNb2;

    /**
     * @var int
     *
     * @ORM\Column(name="noteNb1", type="integer")
     */
    private $noteNb1;


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

    /**
     * Set noteGlobal.
     *
     * @param int $noteGlobal
     *
     * @return VoteCandidature
     */
    public function setNoteGlobal($noteGlobal)
    {
        $this->noteGlobal = $noteGlobal;

        return $this;
    }

    /**
     * Get noteGlobal.
     *
     * @return int
     */
    public function getNoteGlobal()
    {
        return $this->noteGlobal;
    }

    /**
     * Set noteNumber.
     *
     * @param int $noteNumber
     *
     * @return VoteCandidature
     */
    public function setNoteNumber($noteNumber)
    {
        $this->noteNumber = $noteNumber;

        return $this;
    }

    /**
     * Get noteNumber.
     *
     * @return int
     */
    public function getNoteNumber()
    {
        return $this->noteNumber;
    }

    /**
     * Set noteAvg.
     *
     * @param float $noteAvg
     *
     * @return VoteCandidature
     */
    public function setNoteAvg($noteAvg)
    {
        $this->noteAvg = $noteAvg;

        return $this;
    }

    /**
     * Get noteAvg.
     *
     * @return float
     */
    public function getNoteAvg()
    {
        return $this->noteAvg;
    }

    /**
     * Set noteNb5.
     *
     * @param int $noteNb5
     *
     * @return VoteCandidature
     */
    public function setNoteNb5($noteNb5)
    {
        $this->noteNb5 = $noteNb5;

        return $this;
    }

    /**
     * Get noteNb5.
     *
     * @return int
     */
    public function getNoteNb5()
    {
        return $this->noteNb5;
    }

    /**
     * Set noteNb4.
     *
     * @param int $noteNb4
     *
     * @return VoteCandidature
     */
    public function setNoteNb4($noteNb4)
    {
        $this->noteNb4 = $noteNb4;

        return $this;
    }

    /**
     * Get noteNb4.
     *
     * @return int
     */
    public function getNoteNb4()
    {
        return $this->noteNb4;
    }

    /**
     * Set noteNb3.
     *
     * @param int $noteNb3
     *
     * @return VoteCandidature
     */
    public function setNoteNb3($noteNb3)
    {
        $this->noteNb3 = $noteNb3;

        return $this;
    }

    /**
     * Get noteNb3.
     *
     * @return int
     */
    public function getNoteNb3()
    {
        return $this->noteNb3;
    }

    /**
     * Set noteNb2.
     *
     * @param int $noteNb2
     *
     * @return VoteCandidature
     */
    public function setNoteNb2($noteNb2)
    {
        $this->noteNb2 = $noteNb2;

        return $this;
    }

    /**
     * Get noteNb2.
     *
     * @return int
     */
    public function getNoteNb2()
    {
        return $this->noteNb2;
    }

    /**
     * Set noteNb1.
     *
     * @param int $noteNb1
     *
     * @return VoteCandidature
     */
    public function setNoteNb1($noteNb1)
    {
        $this->noteNb1 = $noteNb1;

        return $this;
    }

    /**
     * Get noteNb1.
     *
     * @return int
     */
    public function getNoteNb1()
    {
        return $this->noteNb1;
    }
}
