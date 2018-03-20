<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\CoreBundle\Twig\Extension\TemplateExtension;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Campagne
 *
 * @ORM\Table(name="campagne")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CampagneRepository")
 * @Vich\Uploadable
 */
class Campagne
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
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255, unique=true)
     */
    private $libelle;

    /**
     * @var String
     * @Gedmo\Slug(fields={"libelle"})
     * @ORM\Column(length=128, unique=true, nullable=false)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $logo;

    /**
     * @Vich\UploadableField(mapping="campagnes_logos", fileNameProperty="logo")
     * @var File
     */
    private $logoFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $visuel;

    /**
     * @Vich\UploadableField(mapping="campagnes_visuels", fileNameProperty="visuel")
     * @var File
     */
    private $visuelFile;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $codeHtml;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $codeCss;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $confirmMail;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $confirmText;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $typeRole;

    /**
     * @param File|null $image
     */
    public function setLogoFile(File $image = null)
    {
        $this->logoFile = $image;

        if($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return mixed
     */
    public function getLogoFile()
    {
        return $this->logoFile;
    }

    /**
     * @param String $logo
     * @return $this
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param File|null $image
     */
    public function setVisuelFile(File $image = null)
    {
        $this->visuelFile = $image;

        if($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getVisuelFile()
    {
        return $this->visuelFile;
    }

    /**
     * @param String $visuel
     * @return $this
     */
    public function setVisuel($visuel)
    {
        $this->visuel = $visuel;

        return $this;
    }

    /**
     * @return string
     */
    public function getVisuel()
    {
        return $this->visuel;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Campagne
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param $slug
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return String
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param $typeRole
     * @return $this
     */
    public function setTypeRole($typeRole)
    {
        $this->typeRole = $typeRole;

        return $this;
    }

    /**
     * @return int
     */
    public function getTypeRole()
    {
        return $this->typeRole;
    }

    /**
     * @param $html
     * @return $this
     */
    public function setCodeHtml($html)
    {
        $this->codeHtml = $html;

        return $this;
    }

    /**
     * @return string
     */
    public function getCodeHtml()
    {
        return $this->codeHtml;
    }

    /**
     * @param $css
     * @return $this
     */
    public function setCodeCss($css)
    {
        $this->codeCss = $css;

        return $this;
    }

    /**
     * @return string
     */
    public function getCodeCss()
    {
        return $this->codeCss;
    }

    /**
     * @return string
     */
    public function getConfirmMail()
    {
        return $this->confirmMail;
    }

    /**
     * @param string $confirmMail
     * @return Campagne
     */
    public function setConfirmMail($confirmMail)
    {
        $this->confirmMail = $confirmMail;
        return $this;
    }

    /**
     * @return string
     */
    public function getConfirmText()
    {
        return $this->confirmText;
    }

    /**
     * @param string $confirmText
     * @return Campagne
     */
    public function setConfirmText($confirmText)
    {
        $this->confirmText = $confirmText;
        return $this;
    }


    /**
     * @return string
     */
    public function __toString() {
       return (string) $this->getLibelle();
    }
}

