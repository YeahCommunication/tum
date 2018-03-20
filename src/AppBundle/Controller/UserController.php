<?php

namespace AppBundle\Controller;

use AppBundle\Manager\CampagneManager;
use AppBundle\Manager\TypeUserManager;
use AppBundle\Manager\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UserController extends Controller
{
    /**
     * @Route("/user/edit", name="user_edit")
     */
    public function indexAction(Request $request)
    {

        $userManager = $this->container->get(UserManager::class);
        $user = $userManager->getUser();

        if($request->isMethod('POST')) {
            $userManager->updateUser($user, $request);
            return $this->redirect($this->generateUrl('homepage'));
        }

        if (!$user){
            return $this->redirectToRoute('fos_user_security_login');
        }

        return $this->render('User/profile-edit.html.twig', [
            'user' => $user,
        ]);
    }

}
