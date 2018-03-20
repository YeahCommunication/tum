<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\TypeUser as Type;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CoachUser
 *
 * @ORM\Table(name="coach_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CoachUserRepository")
 */
class CoachUser extends Type
{

    /**
     * @var string
     *
     * @ORM\Column(name="motif", type="string", length=255)
     */
    private $motif;

    /**
     * @var string
     *
     * @ORM\Column(name="demande", type="text")
     */
    private $demande;

    /**
     * @var int
     *
     * @ORM\Column(name="disponibilites", type="smallint")
     */
    private $disponibilites;

    /**
     * @var \DateTime
     * @ORM\Column(name="birthday", type="date")
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="situation", type="string", length=255)
     */
    private $situation;

    /**
     * @var Campagne
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Campagne", cascade={"persist"})
     */
    private $campagne;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateFirstContact;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateRappel;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $consultant;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $tumCommentaires;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tumLastStatut;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tumFinancement;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tumCommentairesCoaching;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tumStatutCoaching;



    /**
     * Set motif
     *
     * @param string $motif
     *
     * @return CoachUser
     */
    public function setMotif($motif)
    {
        $this->motif = $motif;

        return $this;
    }

    /**
     * Get motif
     *
     * @return string
     */
    public function getMotif()
    {
        return $this->motif;
    }

    /**
     * Set demande
     *
     * @param string $demande
     *
     * @return CoachUser
     */
    public function setDemande($demande)
    {
        $this->demande = $demande;

        return $this;
    }

    /**
     * Get demande
     *
     * @return string
     */
    public function getDemande()
    {
        return $this->demande;
    }

    /**
     * @return int
     */
    public function getDisponibilites()
    {
        return $this->disponibilites;
    }

    /**
     * @param int $disponibilites
     * @return CoachUser
     */
    public function setDisponibilites($disponibilites)
    {
        $this->disponibilites = $disponibilites;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param \DateTime $birthday
     * @return CoachUser
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return string
     */
    public function getSituation()
    {
        return $this->situation;
    }

    /**
     * @param string $situation
     * @return CoachUser
     */
    public function setSituation($situation)
    {
        $this->situation = $situation;
        return $this;
    }

    /**
     * @return Campagne
     */
    public function getCampagne()
    {
        return $this->campagne;
    }

    /**
     * @param Campagne $campagne
     * @return CoachUser
     */
    public function setCampagne($campagne)
    {
        $this->campagne = $campagne;
        return $this;
    }

    /**
     * Get created at.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getDateFirstContact()
    {
        return $this->dateFirstContact;
    }

    /**
     * @param \DateTime $dateFirstContact
     * @return CoachUser
     */
    public function setDateFirstContact($dateFirstContact)
    {
        $this->dateFirstContact = $dateFirstContact;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateRappel()
    {
        return $this->dateRappel;
    }

    /**
     * @param \DateTime $dateRappel
     * @return CoachUser
     */
    public function setDateRappel($dateRappel)
    {
        $this->dateRappel = $dateRappel;
        return $this;
    }

    /**
     * @return string
     */
    public function getConsultant()
    {
        return $this->consultant;
    }

    /**
     * @param string $consultant
     * @return CoachUser
     */
    public function setConsultant($consultant)
    {
        $this->consultant = $consultant;
        return $this;
    }

    /**
     * @return string
     */
    public function getTumCommentaires()
    {
        return $this->tumCommentaires;
    }

    /**
     * @param string $tumCommentaires
     * @return CoachUser
     */
    public function setTumCommentaires($tumCommentaires)
    {
        $this->tumCommentaires = $tumCommentaires;
        return $this;
    }

    /**
     * @return string
     */
    public function getTumLastStatut()
    {
        return $this->tumLastStatut;
    }

    /**
     * @param string $tumLastStatut
     * @return CoachUser
     */
    public function setTumLastStatut($tumLastStatut)
    {
        $this->tumLastStatut = $tumLastStatut;
        return $this;
    }

    /**
     * @return string
     */
    public function getTumFinancement()
    {
        return $this->tumFinancement;
    }

    /**
     * @param string $tumFinancement
     * @return CoachUser
     */
    public function setTumFinancement($tumFinancement)
    {
        $this->tumFinancement = $tumFinancement;
        return $this;
    }

    /**
     * @return string
     */
    public function getTumCommentairesCoaching()
    {
        return $this->tumCommentairesCoaching;
    }

    /**
     * @param string $tumCommentairesCoaching
     * @return CoachUser
     */
    public function setTumCommentairesCoaching($tumCommentairesCoaching)
    {
        $this->tumCommentairesCoaching = $tumCommentairesCoaching;
        return $this;
    }

    /**
     * @return string
     */
    public function getTumStatutCoaching()
    {
        return $this->tumStatutCoaching;
    }

    /**
     * @param string $tumStatutCoaching
     * @return CoachUser
     */
    public function setTumStatutCoaching($tumStatutCoaching)
    {
        $this->tumStatutCoaching = $tumStatutCoaching;
        return $this;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return "Coach";
    }
}

