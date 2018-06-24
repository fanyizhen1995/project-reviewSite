<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImageRepository")
 */
class Image
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
     * @ORM\Column(name="isPoster", type="boolean")
     */
    private $isPoster;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

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
     * Set isPoster.
     *
     * @param bool $isPoster
     *
     * @return Image
     */
    public function setIsPoster($isPoster)
    {
        $this->isPoster = $isPoster;

        return $this;
    }

    /**
     * Get isPoster.
     *
     * @return bool
     */
    public function getIsPoster()
    {
        return $this->isPoster;
    }

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
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
}
