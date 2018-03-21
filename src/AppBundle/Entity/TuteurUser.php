<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\TypeUser as Type;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TuteurUser
 *
 * @ORM\Table(name="tuteur_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TuteurUserRepository")
 */
class TuteurUser extends Type
{

    /**
     * @var string
     *
     * @ORM\Column(name="motivations", type="text")
     */
    private $motivations;

    /**
     * @var string
     *
     * @ORM\Column(name="immersion_metier", type="string", length=255)
     */
    private $immersionMetier;

    /**
     * @var string
     *
     * @ORM\Column(name="immersion_commentaire", type="text")
     */
    private $immersionCommentaire;

    /**
     * @var int
     *
     * @ORM\Column(name="disponibilites", type="smallint")
     */
    private $disponibilites;

    /**
     * @var int
     *
     * @ORM\Column(name="type_remuneration", type="smallint")
     */
    private $typeRemuneration;

    /**
     * @var float
     *
     * @ORM\Column(name="ammount_remuneration", type="float")
     */
    private $ammountRemuneration;

    /**
     * @var int
     *
     * @ORM\Column(name="duree_testeur", type="smallint")
     */
    private $dureeTesteur;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaires", type="text", nullable=true)
     */
    private $commentaires;

    /**
     * @var string
     *
     * @ORM\Column(name="situation", type="string", length=255)
     */
    private $situation;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_name", type="string", length=255, nullable=true)
     */
    private $agencyName;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_address", type="string", length=255, nullable=true)
     */
    private $agencyAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_address2", type="string", length=255, nullable=true)
     */
    private $agencyAddress2;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_postalcode", type="string", length=255, nullable=true)
     */
    private $agencyPostalcode;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_city", type="string", length=255, nullable=true)
     */
    private $agencyCity;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_nb", type="string", length=255, nullable=true)
     */
    private $agencyNb;

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
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $raisonSociale;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siret;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $capitalSocial;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $representantLegal;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $metierList;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $metier2;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tache2;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contreIndication;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horaires;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $secteur;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $appAffaire;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $consultant;

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
    private $tumLastStatut;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $tumCommentaires;


    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avisTuteur;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $avisTuteurPublication;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avisTum;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avisAccompagnement;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $avisExperience;

    /**
     * Set motivations
     *
     * @param string $motivations
     *
     * @return TuteurUser
     */
    public function setMotivations($motivations)
    {
        $this->motivations = $motivations;

        return $this;
    }

    /**
     * Get motivations
     *
     * @return string
     */
    public function getMotivations()
    {
        return $this->motivations;
    }

    /**
     * Set immersionMetier
     *
     * @param string $immersionMetier
     *
     * @return TuteurUser
     */
    public function setImmersionMetier($immersionMetier)
    {
        $this->immersionMetier = $immersionMetier;

        return $this;
    }

    /**
     * Get immersionMetier
     *
     * @return string
     */
    public function getImmersionMetier()
    {
        return $this->immersionMetier;
    }

    /**
     * Set disponibilites
     *
     * @param integer $disponibilites
     *
     * @return TuteurUser
     */
    public function setDisponibilites($disponibilites)
    {
        $this->disponibilites = $disponibilites;

        return $this;
    }

    /**
     * Get disponibilites
     *
     * @return int
     */
    public function getDisponibilites()
    {
        return $this->disponibilites;
    }

    /**
     * Set typeRemuneration
     *
     * @param integer $typeRemuneration
     *
     * @return TuteurUser
     */
    public function setTypeRemuneration($typeRemuneration)
    {
        $this->typeRemuneration = $typeRemuneration;

        return $this;
    }

    /**
     * Get typeRemuneration
     *
     * @return int
     */
    public function getTypeRemuneration()
    {
        return $this->typeRemuneration;
    }

    /**
     * Set ammountRemuneration
     *
     * @param float $ammountRemuneration
     *
     * @return TuteurUser
     */
    public function setAmmountRemuneration($ammountRemuneration)
    {
        $this->ammountRemuneration = $ammountRemuneration;

        return $this;
    }

    /**
     * Get ammountRemuneration
     *
     * @return float
     */
    public function getAmmountRemuneration()
    {
        return $this->ammountRemuneration;
    }

    /**
     * Set dureeTesteur
     *
     * @param integer $dureeTesteur
     *
     * @return TuteurUser
     */
    public function setDureeTesteur($dureeTesteur)
    {
        $this->dureeTesteur = $dureeTesteur;

        return $this;
    }

    /**
     * Get dureeTesteur
     *
     * @return int
     */
    public function getDureeTesteur()
    {
        return $this->dureeTesteur;
    }

    /**
     * Set commentaires
     *
     * @param string $commentaires
     *
     * @return TuteurUser
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    /**
     * Get commentaires
     *
     * @return string
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * @return string
     */
    public function getImmersionCommentaire()
    {
        return $this->immersionCommentaire;
    }

    /**
     * @param string $immersionCommentaire
     * @return TuteurUser
     */
    public function setImmersionCommentaire($immersionCommentaire)
    {
        $this->immersionCommentaire = $immersionCommentaire;
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
     * @return TuteurUser
     */
    public function setSituation($situation)
    {
        $this->situation = $situation;
        return $this;
    }

    /**
     * @return string
     */
    public function getAgencyName()
    {
        return $this->agencyName;
    }

    /**
     * @param string $agencyName
     * @return TuteurUser
     */
    public function setAgencyName($agencyName)
    {
        $this->agencyName = $agencyName;
        return $this;
    }

    /**
     * @return string
     */
    public function getAgencyAddress()
    {
        return $this->agencyAddress;
    }

    /**
     * @param string $agencyAddress
     * @return TuteurUser
     */
    public function setAgencyAddress($agencyAddress)
    {
        $this->agencyAddress = $agencyAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getAgencyAddress2()
    {
        return $this->agencyAddress2;
    }

    /**
     * @param string $agencyAddress2
     * @return TuteurUser
     */
    public function setAgencyAddress2($agencyAddress2)
    {
        $this->agencyAddress2 = $agencyAddress2;
        return $this;
    }

    /**
     * @return string
     */
    public function getAgencyPostalcode()
    {
        return $this->agencyPostalcode;
    }

    /**
     * @param string $agencyPostalcode
     * @return TuteurUser
     */
    public function setAgencyPostalcode($agencyPostalcode)
    {
        $this->agencyPostalcode = $agencyPostalcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getAgencyCity()
    {
        return $this->agencyCity;
    }

    /**
     * @param string $agencyCity
     * @return TuteurUser
     */
    public function setAgencyCity($agencyCity)
    {
        $this->agencyCity = $agencyCity;
        return $this;
    }

    /**
     * @return string
     */
    public function getAgencyNb()
    {
        return $this->agencyNb;
    }

    /**
     * @param string $agencyNb
     * @return TuteurUser
     */
    public function setAgencyNb($agencyNb)
    {
        $this->agencyNb = $agencyNb;
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
     * @return TuteurUser
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
     * @return string
     */
    public function getRaisonSociale()
    {
        return $this->raisonSociale;
    }

    /**
     * @param string $raisonSociale
     * @return TuteurUser
     */
    public function setRaisonSociale($raisonSociale)
    {
        $this->raisonSociale = $raisonSociale;
        return $this;
    }

    /**
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * @param string $siret
     * @return TuteurUser
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
        return $this;
    }

    /**
     * @return string
     */
    public function getCapitalSocial()
    {
        return $this->capitalSocial;
    }

    /**
     * @param string $capitalSocial
     * @return TuteurUser
     */
    public function setCapitalSocial($capitalSocial)
    {
        $this->capitalSocial = $capitalSocial;
        return $this;
    }

    /**
     * @return string
     */
    public function getRepresentantLegal()
    {
        return $this->representantLegal;
    }

    /**
     * @param string $representantLegal
     * @return TuteurUser
     */
    public function setRepresentantLegal($representantLegal)
    {
        $this->representantLegal = $representantLegal;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetierList()
    {
        return $this->metierList;
    }

    /**
     * @param string $metierList
     * @return TuteurUser
     */
    public function setMetierList($metierList)
    {
        $this->metierList = $metierList;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetier2()
    {
        return $this->metier2;
    }

    /**
     * @param string $metier2
     * @return TuteurUser
     */
    public function setMetier2($metier2)
    {
        $this->metier2 = $metier2;
        return $this;
    }

    /**
     * @return string
     */
    public function getTache2()
    {
        return $this->tache2;
    }

    /**
     * @param string $tache2
     * @return TuteurUser
     */
    public function setTache2($tache2)
    {
        $this->tache2 = $tache2;
        return $this;
    }

    /**
     * @return string
     */
    public function getContreIndication()
    {
        return $this->contreIndication;
    }

    /**
     * @param string $contreIndication
     * @return TuteurUser
     */
    public function setContreIndication($contreIndication)
    {
        $this->contreIndication = $contreIndication;
        return $this;
    }

    /**
     * @return string
     */
    public function getHoraires()
    {
        return $this->horaires;
    }

    /**
     * @param string $horaires
     * @return TuteurUser
     */
    public function setHoraires($horaires)
    {
        $this->horaires = $horaires;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecteur()
    {
        return $this->secteur;
    }

    /**
     * @param string $secteur
     * @return TuteurUser
     */
    public function setSecteur($secteur)
    {
        $this->secteur = $secteur;
        return $this;
    }

    /**
     * @return string
     */
    public function getAppAffaire()
    {
        return $this->appAffaire;
    }

    /**
     * @param string $appAffaire
     * @return TuteurUser
     */
    public function setAppAffaire($appAffaire)
    {
        $this->appAffaire = $appAffaire;
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
     * @return TuteurUser
     */
    public function setConsultant($consultant)
    {
        $this->consultant = $consultant;
        return $this;
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
     * @return TuteurUser
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
     * @return TuteurUser
     */
    public function setDateRappel($dateRappel)
    {
        $this->dateRappel = $dateRappel;
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
     * @return TuteurUser
     */
    public function setTumLastStatut($tumLastStatut)
    {
        $this->tumLastStatut = $tumLastStatut;
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
     * @return TuteurUser
     */
    public function setTumCommentaires($tumCommentaires)
    {
        $this->tumCommentaires = $tumCommentaires;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvisTuteur()
    {
        return $this->avisTuteur;
    }

    /**
     * @param string $avisTuteur
     * @return TuteurUser
     */
    public function setAvisTuteur($avisTuteur)
    {
        $this->avisTuteur = $avisTuteur;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAvisTuteurPublication()
    {
        return $this->avisTuteurPublication;
    }

    /**
     * @param bool $avisTuteurPublication
     * @return TuteurUser
     */
    public function setAvisTuteurPublication($avisTuteurPublication)
    {
        $this->avisTuteurPublication = $avisTuteurPublication;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvisTum()
    {
        return $this->avisTum;
    }

    /**
     * @param string $avisTum
     * @return TuteurUser
     */
    public function setAvisTum($avisTum)
    {
        $this->avisTum = $avisTum;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvisAccompagnement()
    {
        return $this->avisAccompagnement;
    }

    /**
     * @param string $avisAccompagnement
     * @return TuteurUser
     */
    public function setAvisAccompagnement($avisAccompagnement)
    {
        $this->avisAccompagnement = $avisAccompagnement;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAvisExperience()
    {
        return $this->avisExperience;
    }

    /**
     * @param bool $avisExperience
     * @return TuteurUser
     */
    public function setAvisExperience($avisExperience)
    {
        $this->avisExperience = $avisExperience;
        return $this;
    }



    /**
     * @return string
     */
    public function __toString()
    {
        if($this->getUser()){
            return $this->getUser()->getFirstname() . ' ' . $this->getUser()->getLastname();
        } else {
            return 'Tuteur';
        }

    }
}

