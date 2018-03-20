<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\TypeUser as Type;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TesteurUser
 *
 * @ORM\Table(name="testeur_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TesteurUserRepository")
 */
class TesteurUser extends Type
{

    /**
     * @var string
     *
     * @ORM\Column(name="projet", type="text")
     */
    private $projet;

    /**
     * @var string
     *
     * @ORM\Column(name="immersion_metier", type="string", length=255)
     */
    private $immersionMetier;

    /**
     * @var string
     *
     * @ORM\Column(name="immersion_commentaire", type="text", nullable=true)
     */
    private $immersionCommentaire;

    /**
     * @var int
     *
     * @ORM\Column(name="disponibilites", type="smallint")
     */
    private $disponibilites;

    /**
     * @var bool
     *
     * @ORM\Column(name="tuteur_identify", type="boolean")
     */
    private $tuteurIdentify;

    /**
     * @var string
     *
     * @ORM\Column(name="situation", type="string", length=255)
     */
    private $situation;

    /**
     * @var \DateTime
     * @ORM\Column(name="birthday", type="date")
     */
    private $birthday;

    /**
     * @var Campagne
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Campagne", cascade={"persist"})
     */
    private $campagne;

    /**
     * @var TuteurUser
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TuteurUser", cascade={"persist"})
     */
    private $tuteur;

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
    private $currentMetier;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $competences;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wishStage;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wishDuree;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wishGeo;

    /**
     * @var string
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $tumCommentaire;

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
    private $consultant;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $consultantDate;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $consultantCommentaire;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tumLastStatutDossier;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $montant;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commissionApporteur;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commissionConsultant;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $suiviPaiement;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    private $avisNote;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avis;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $avisPublication;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avisConsultant;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avisAccueil;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avisCorrespond;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avisCapacite;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $avisRecommander;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $avisObjectifs;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avisNextStep;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $testMetier;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $testTache;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $testDuree;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $testGeo;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $testTuteurName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $testSocieteName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $testSocieteAdress;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $testSocieteCodePostal;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $testSocieteVille;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $testHoraire;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $testContreIndication;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $testIndemnisationTuteur;

    /**
     * Set projet
     *
     * @param string $projet
     *
     * @return TesteurUser
     */
    public function setProjet($projet)
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get projet
     *
     * @return string
     */
    public function getProjet()
    {
        return $this->projet;
    }

    /**
     * Set immersionMetier
     *
     * @param string $immersionMetier
     *
     * @return TesteurUser
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
     * Set immersionCommentaire
     *
     * @param string $immersionCommentaire
     *
     * @return TesteurUser
     */
    public function setImmersionCommentaire($immersionCommentaire)
    {
        $this->immersionCommentaire = $immersionCommentaire;

        return $this;
    }

    /**
     * Get immersionCommentaire
     *
     * @return string
     */
    public function getImmersionCommentaire()
    {
        return $this->immersionCommentaire;
    }

    /**
     * Set disponibilites
     *
     * @param integer $disponibilites
     *
     * @return TesteurUser
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
     * Set situation
     *
     * @param string $situation
     *
     * @return TesteurUser
     */
    public function setSituation($situation)
    {
        $this->situation = $situation;

        return $this;
    }

    /**
     * Get situation
     *
     * @return string
     */
    public function getSituation()
    {
        return $this->situation;
    }

    /**
     * Get birthday
     *
     * @return date
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set birthday
     *
     * @param date $birthday
     *
     * @return TesteurUser
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @return bool
     */
    public function isTuteurIdentify()
    {
        return $this->tuteurIdentify;
    }

    /**
     * @param bool $tuteurIdentify
     * @return TesteurUser
     */
    public function setTuteurIdentify($tuteurIdentify)
    {
        $this->tuteurIdentify = $tuteurIdentify;
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
     * @return TesteurUser
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
     * @return TuteurUser
     */
    public function getTuteur()
    {
        return $this->tuteur;
    }

    /**
     * @param TuteurUser $tuteur
     * @return TesteurUser
     */
    public function setTuteur($tuteur)
    {
        $this->tuteur = $tuteur;
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
     * @return TesteurUser
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
     * @return TesteurUser
     */
    public function setDateRappel($dateRappel)
    {
        $this->dateRappel = $dateRappel;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrentMetier()
    {
        return $this->currentMetier;
    }

    /**
     * @param string $currentMetier
     * @return TesteurUser
     */
    public function setCurrentMetier($currentMetier)
    {
        $this->currentMetier = $currentMetier;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompetences()
    {
        return $this->competences;
    }

    /**
     * @param string $competences
     * @return TesteurUser
     */
    public function setCompetences($competences)
    {
        $this->competences = $competences;
        return $this;
    }

    /**
     * @return string
     */
    public function getWishStage()
    {
        return $this->wishStage;
    }

    /**
     * @param string $wishStage
     * @return TesteurUser
     */
    public function setWishStage($wishStage)
    {
        $this->wishStage = $wishStage;
        return $this;
    }

    /**
     * @return string
     */
    public function getWishDuree()
    {
        return $this->wishDuree;
    }

    /**
     * @param string $wishDuree
     * @return TesteurUser
     */
    public function setWishDuree($wishDuree)
    {
        $this->wishDuree = $wishDuree;
        return $this;
    }

    /**
     * @return string
     */
    public function getWishGeo()
    {
        return $this->wishGeo;
    }

    /**
     * @param string $wishGeo
     * @return TesteurUser
     */
    public function setWishGeo($wishGeo)
    {
        $this->wishGeo = $wishGeo;
        return $this;
    }

    /**
     * @return string
     */
    public function getTumCommentaire()
    {
        return $this->tumCommentaire;
    }

    /**
     * @param string $tumCommentaire
     * @return TesteurUser
     */
    public function setTumCommentaire($tumCommentaire)
    {
        $this->tumCommentaire = $tumCommentaire;
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
     * @return TesteurUser
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
     * @return TesteurUser
     */
    public function setTumFinancement($tumFinancement)
    {
        $this->tumFinancement = $tumFinancement;
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
     * @return TesteurUser
     */
    public function setConsultant($consultant)
    {
        $this->consultant = $consultant;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getConsultantDate()
    {
        return $this->consultantDate;
    }

    /**
     * @param \DateTime $consultantDate
     * @return TesteurUser
     */
    public function setConsultantDate($consultantDate)
    {
        $this->consultantDate = $consultantDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getConsultantCommentaire()
    {
        return $this->consultantCommentaire;
    }

    /**
     * @param string $consultantCommentaire
     * @return TesteurUser
     */
    public function setConsultantCommentaire($consultantCommentaire)
    {
        $this->consultantCommentaire = $consultantCommentaire;
        return $this;
    }

    /**
     * @return string
     */
    public function getTumLastStatutDossier()
    {
        return $this->tumLastStatutDossier;
    }

    /**
     * @param string $tumLastStatutDossier
     * @return TesteurUser
     */
    public function setTumLastStatutDossier($tumLastStatutDossier)
    {
        $this->tumLastStatutDossier = $tumLastStatutDossier;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param \DateTime $dateDebut
     * @return TesteurUser
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param \DateTime $dateFin
     * @return TesteurUser
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
        return $this;
    }

    /**
     * @return string
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param string $montant
     * @return TesteurUser
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
        return $this;
    }

    /**
     * @return string
     */
    public function getCommissionApporteur()
    {
        return $this->commissionApporteur;
    }

    /**
     * @param string $commissionApporteur
     * @return TesteurUser
     */
    public function setCommissionApporteur($commissionApporteur)
    {
        $this->commissionApporteur = $commissionApporteur;
        return $this;
    }

    /**
     * @return string
     */
    public function getCommissionConsultant()
    {
        return $this->commissionConsultant;
    }

    /**
     * @param string $commissionConsultant
     * @return TesteurUser
     */
    public function setCommissionConsultant($commissionConsultant)
    {
        $this->commissionConsultant = $commissionConsultant;
        return $this;
    }

    /**
     * @return string
     */
    public function getSuiviPaiement()
    {
        return $this->suiviPaiement;
    }

    /**
     * @param string $suiviPaiement
     * @return TesteurUser
     */
    public function setSuiviPaiement($suiviPaiement)
    {
        $this->suiviPaiement = $suiviPaiement;
        return $this;
    }

    /**
     * @return int
     */
    public function getAvisNote()
    {
        return $this->avisNote;
    }

    /**
     * @param int $avisNote
     * @return TesteurUser
     */
    public function setAvisNote($avisNote)
    {
        $this->avisNote = $avisNote;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvis()
    {
        return $this->avis;
    }

    /**
     * @param string $avis
     * @return TesteurUser
     */
    public function setAvis($avis)
    {
        $this->avis = $avis;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvisPublication()
    {
        return $this->avisPublication;
    }

    /**
     * @param string $avisPublication
     * @return TesteurUser
     */
    public function setAvisPublication($avisPublication)
    {
        $this->avisPublication = $avisPublication;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvisConsultant()
    {
        return $this->avisConsultant;
    }

    /**
     * @param string $avisConsultant
     * @return TesteurUser
     */
    public function setAvisConsultant($avisConsultant)
    {
        $this->avisConsultant = $avisConsultant;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvisAccueil()
    {
        return $this->avisAccueil;
    }

    /**
     * @param string $avisAccueil
     * @return TesteurUser
     */
    public function setAvisAccueil($avisAccueil)
    {
        $this->avisAccueil = $avisAccueil;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvisCorrespond()
    {
        return $this->avisCorrespond;
    }

    /**
     * @param string $avisCorrespond
     * @return TesteurUser
     */
    public function setAvisCorrespond($avisCorrespond)
    {
        $this->avisCorrespond = $avisCorrespond;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvisCapacite()
    {
        return $this->avisCapacite;
    }

    /**
     * @param string $avisCapacite
     * @return TesteurUser
     */
    public function setAvisCapacite($avisCapacite)
    {
        $this->avisCapacite = $avisCapacite;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvisRecommander()
    {
        return $this->avisRecommander;
    }

    /**
     * @param string $avisRecommander
     * @return TesteurUser
     */
    public function setAvisRecommander($avisRecommander)
    {
        $this->avisRecommander = $avisRecommander;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvisObjectifs()
    {
        return $this->avisObjectifs;
    }

    /**
     * @param string $avisObjectifs
     * @return TesteurUser
     */
    public function setAvisObjectifs($avisObjectifs)
    {
        $this->avisObjectifs = $avisObjectifs;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvisNextStep()
    {
        return $this->avisNextStep;
    }

    /**
     * @param string $avisNextStep
     * @return TesteurUser
     */
    public function setAvisNextStep($avisNextStep)
    {
        $this->avisNextStep = $avisNextStep;
        return $this;
    }

    /**
     * @return string
     */
    public function getTestMetier()
    {
        return $this->testMetier;
    }

    /**
     * @param string $testMetier
     * @return TesteurUser
     */
    public function setTestMetier($testMetier)
    {
        $this->testMetier = $testMetier;
        return $this;
    }

    /**
     * @return string
     */
    public function getTestTache()
    {
        return $this->testTache;
    }

    /**
     * @param string $testTache
     * @return TesteurUser
     */
    public function setTestTache($testTache)
    {
        $this->testTache = $testTache;
        return $this;
    }

    /**
     * @return string
     */
    public function getTestDuree()
    {
        return $this->testDuree;
    }

    /**
     * @param string $testDuree
     * @return TesteurUser
     */
    public function setTestDuree($testDuree)
    {
        $this->testDuree = $testDuree;
        return $this;
    }

    /**
     * @return string
     */
    public function getTestGeo()
    {
        return $this->testGeo;
    }

    /**
     * @param string $testGeo
     * @return TesteurUser
     */
    public function setTestGeo($testGeo)
    {
        $this->testGeo = $testGeo;
        return $this;
    }

    /**
     * @return string
     */
    public function getTestTuteurName()
    {
        return $this->testTuteurName;
    }

    /**
     * @param string $testTuteurName
     * @return TesteurUser
     */
    public function setTestTuteurName($testTuteurName)
    {
        $this->testTuteurName = $testTuteurName;
        return $this;
    }

    /**
     * @return string
     */
    public function getTestSocieteName()
    {
        return $this->testSocieteName;
    }

    /**
     * @param string $testSocieteName
     * @return TesteurUser
     */
    public function setTestSocieteName($testSocieteName)
    {
        $this->testSocieteName = $testSocieteName;
        return $this;
    }

    /**
     * @return string
     */
    public function getTestSocieteAdress()
    {
        return $this->testSocieteAdress;
    }

    /**
     * @param string $testSocieteAdress
     * @return TesteurUser
     */
    public function setTestSocieteAdress($testSocieteAdress)
    {
        $this->testSocieteAdress = $testSocieteAdress;
        return $this;
    }

    /**
     * @return string
     */
    public function getTestSocieteCodePostal()
    {
        return $this->testSocieteCodePostal;
    }

    /**
     * @param string $testSocieteCodePostal
     * @return TesteurUser
     */
    public function setTestSocieteCodePostal($testSocieteCodePostal)
    {
        $this->testSocieteCodePostal = $testSocieteCodePostal;
        return $this;
    }

    /**
     * @return string
     */
    public function getTestSocieteVille()
    {
        return $this->testSocieteVille;
    }

    /**
     * @param string $testSocieteVille
     * @return TesteurUser
     */
    public function setTestSocieteVille($testSocieteVille)
    {
        $this->testSocieteVille = $testSocieteVille;
        return $this;
    }

    /**
     * @return string
     */
    public function getTestHoraire()
    {
        return $this->testHoraire;
    }

    /**
     * @param string $testHoraire
     * @return TesteurUser
     */
    public function setTestHoraire($testHoraire)
    {
        $this->testHoraire = $testHoraire;
        return $this;
    }

    /**
     * @return string
     */
    public function getTestContreIndication()
    {
        return $this->testContreIndication;
    }

    /**
     * @param string $testContreIndication
     * @return TesteurUser
     */
    public function setTestContreIndication($testContreIndication)
    {
        $this->testContreIndication = $testContreIndication;
        return $this;
    }

    /**
     * @return string
     */
    public function getTestIndemnisationTuteur()
    {
        return $this->testIndemnisationTuteur;
    }

    /**
     * @param string $testIndemnisationTuteur
     * @return TesteurUser
     */
    public function setTestIndemnisationTuteur($testIndemnisationTuteur)
    {
        $this->testIndemnisationTuteur = $testIndemnisationTuteur;
        return $this;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return "Testeur";
    }
}

