<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * User
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $oldId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $postalCode;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TypeUser", mappedBy="user")
     */
    private $types;

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
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $visibilite;
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $visibiliteAutre;



    public function __construct()
    {
        parent::__construct();
        $this->types = new ArrayCollection();
    }

    public function setEmail($email)
    {

        $this->email = $email;
        $this->username = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     * @return User
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param ArrayCollection $types
     * @return User
     */
    public function setType(ArrayCollection $types)
    {
        $this->types = $types;
        return $this;
    }

    public function addType(TypeUser $typeUser)
    {
        /*
        if(!$this->types->contains($typeUser) && $this->canAddType($typeUser)) {
            $typeUser->setUser($this);
            $this->types->add($typeUser);
        }
        */
        $typeUser->setUser($this);
        $this->types->add($typeUser);
    }

    /**
     * @param TypeUser $typeUser
     * @return bool
     */
    public function canAddType(TypeUser $typeUser)
    {
        $canAdd = true;
        foreach($this->types as $type)
        {
            if($type instanceof $typeUser) {
                $canAdd = false;
            }
        }

        return $canAdd;
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
     * @return $this
     */
    public function setCampagne(Campagne $campagne)
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
     *
     * @param \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     * @return User
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
        return $this;
    }

    /**
     * @return string
     */
    public function getVisibilite()
    {
        return $this->visibilite;
    }

    /**
     * @param string $visibilite
     * @return User
     */
    public function setVisibilite($visibilite)
    {
        $this->visibilite = $visibilite;
        return $this;
    }

    /**
     * @return string
     */
    public function getVisibiliteAutre()
    {
        return $this->visibiliteAutre;
    }

    /**
     * @param string $visibiliteAutre
     * @return User
     */
    public function setVisibiliteAutre($visibiliteAutre)
    {
        $this->visibiliteAutre = $visibiliteAutre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOldId()
    {
        return $this->oldId;
    }

    /**
     * @param mixed $oldId
     * @return User
     */
    public function setOldId($oldId)
    {
        $this->oldId = $oldId;
        return $this;
    }



    public function __toString()
    {
        return (string) $this->firstname." ".$this->lastname;
    }
}
