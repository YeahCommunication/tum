<?php
namespace AppBundle\Manager;


use AppBundle\Entity\Campagne;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\Templating\EngineInterface;

class CampagneManager
{

    private $entityManager;
    private $cmsManager;
    private $mailer;

    public function __construct(EntityManagerInterface $entityManager, CmsManager $cmsManager, \Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->entityManager = $entityManager;
        $this->cmsManager = $cmsManager;
        $this->templating = $templating;
        $this->mailer = $mailer;
    }

    public function getCampagneById($id)
    {
        $repo = $this->entityManager->getRepository(Campagne::class);
        $campagne = $repo->findOneById($id);

        return $campagne;
    }

    public function getCampagneBySlug($slug)
    {
        $repo = $this->entityManager->getRepository(Campagne::class);
        $campagne = $repo->findOneBySlug($slug);

        return $campagne;
    }

    /**
     * Permet de savoir si la campagne concerné possède le menu generique
     * @param Campagne $campagne
     * @return bool $showMenu
     */
    public function showMenu($campagne)
    {
        $showMenu = false;

        if (!$campagne){
            return true;
        }

        if(in_array($campagne->getId(), ['1', '3', '4']) ){
            $showMenu = true;
        }

        return $showMenu;
    }

    public function sendMailConfirmation($roleSelected, User $userConnected, Campagne $campagne)
    {
        $mailSubject = 'Prenons RDV pour échanger de vive voix.';


        $body = $this->templating->render('Emails/campagne.html.twig', [
            'user' => $userConnected,
            'message' => $campagne->getConfirmMail()
        ]);

        $message = (new \Swift_Message($mailSubject))
            ->setFrom(array('contact@testunmetier.com' => 'Testunmetier.com'))
            ->setTo($userConnected->getEmail())
            ->setBody($body, 'text/html');

        $nbMail = $this->mailer->send($message);
        if ($nbMail > 0) {
            $retour['success'] = true;
        } else {
            $retour['success'] = false;
            $retour['message'] = 'Impossible de vous envoyer un mail !';
        }

        return $retour['success'];
    }

    /**
     * @param User $user
     * @param string $plainPassword
     * @return bool
     */
    public function sendMailRegister(User $user, $plainPassword)
    {
        $mailSubject = 'Bienvenue chez Testunmetier.com';


        $body = $this->templating->render('Emails/register.html.twig', [
            'user' => $user,
            'plainPassword' => $plainPassword
        ]);

        $message = (new \Swift_Message($mailSubject))
            ->setFrom(array('contact@testunmetier.com' => 'Testunmetier.com'))
            ->setTo($user->getEmail())
            ->setBody($body, 'text/html');

        $this->mailer->send($message);

        return true;
    }
}