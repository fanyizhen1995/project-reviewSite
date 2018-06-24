<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientVote
 *
 * @ORM\Table(name="client_vote")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientVoteRepository")
 */
class ClientVote
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
     * @var bool
     *
     * @ORM\Column(name="isCreator", type="boolean")
     */
    private $isCreator;

    /**
     * @var bool
     *
     * @ORM\Column(name="isParticipant", type="boolean")
     */
    private $isParticipant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(name="client", referencedColumnName="id", onDelete="CASCADE")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="Vote")
     * @ORM\JoinColumn(name="vote", referencedColumnName="id", onDelete="CASCADE")
     */
    private $vote;

    /**
     * @return mixed
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * @param mixed $vote
     */
    public function setVote($vote)
    {
        $this->vote = $vote;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }


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
     * Set isCreator.
     *
     * @param bool $isCreator
     *
     * @return ClientVote
     */
    public function setIsCreator($isCreator)
    {
        $this->isCreator = $isCreator;

        return $this;
    }

    /**
     * Get isCreator.
     *
     * @return bool
     */
    public function getIsCreator()
    {
        return $this->isCreator;
    }

    /**
     * Set isParticipant.
     *
     * @param bool $isParticipant
     *
     * @return ClientVote
     */
    public function setIsParticipant($isParticipant)
    {
        $this->isParticipant = $isParticipant;

        return $this;
    }

    /**
     * Get isParticipant.
     *
     * @return bool
     */
    public function getIsParticipant()
    {
        return $this->isParticipant;
    }

    /**
     * Set creationDate.
     *
     * @param \DateTime $creationDate
     *
     * @return ClientVote
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate.
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }
}
