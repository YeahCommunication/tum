<?php
namespace AppBundle\Controller;


use AppBundle\Entity\Campagne;
use AppBundle\Manager\CampagneManager;
use AppBundle\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CampagneController extends Controller
{

    /**
     * @Route("/campagne/{slug}.html", name="campagne_show")
     */
    public function showAction($slug)
    {
        $campagneManager = $this->container->get(CampagneManager::class);

        /** @var Campagne $campagne */
        $campagne = $campagneManager->getCampagneBySlug($slug);
        $userManager = $this->container->get(UserManager::class);
        $userConnected = $userManager->getUser();

        if(!$campagne) {
            return $this->redirectToRoute('homepage');
        }

        if($campagne->getTypeRole() == '1')  {
            $roleSelected = 'testeur';
        } elseif($campagne->getTypeRole() == '2') {
            $roleSelected = 'tuteur';
        } elseif($campagne->getTypeRole() == '3') {
            $roleSelected = 'coach';
        } else {
            $roleSelected = 'null';
        }

        if($userConnected) {
            return $this->redirectToRoute('inscription', ['type' => $roleSelected, 'campagne' => $campagne->getId()]);
        }

        // condition affichage menu
        $showMenu = $campagneManager->showMenu($campagne);

        return $this->render('default/campagne.html.twig', array(
            'campagne' => $campagne,
            'roleSelected' => $roleSelected,
            'showMenu' => $showMenu
        ));
    }
}