<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Campagne;
use AppBundle\Entity\User;
use AppBundle\Manager\CampagneManager;
use AppBundle\Manager\CmsManager;
use AppBundle\Manager\TypeUserManager;
use AppBundle\Manager\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $userManager = $this->container->get(UserManager::class);
        $user = $userManager->getUser();

        if (!$user){
            return $this->redirectToRoute('fos_user_security_login');
        }

        return $this->render('User/profile-home.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/inscription-{type}", name="inscription")
     */
    public function inscriptionAction($type, Request $request)
    {
        $campagneManager = $this->container->get(CampagneManager::class);
        $userManager = $this->container->get(UserManager::class);
        $userConnected = $userManager->getUser();

        /** @var Campagne $campagneReferer */
        $campagneReferer = $campagneManager->getCampagneById($request->get('campagne'));

        $user = null;

        // Si l'user est connecté on le force par défaut
        if($userConnected) $user = $userConnected;

        // Si on inscrit un nouvel utilisateur
        if($request->isXmlHttpRequest()) {
            $retour = array();
            $emailExists = true;

            if(!$userConnected) {
                $findUserByMail = $userManager->findUserByEmail($request->request->get('email'));

                /** @var Campagne $campagne */
                $campagne = $campagneManager->getCampagneById($request->request->get('campagne_source'));

                if(!$findUserByMail) {
                    $datas = [
                        'password' => $request->request->get('password'),
                        'email' => $request->request->get('email'),
                        'gender' => $request->request->get('gender'),
                        'postal_code' => $request->request->get('postal_code'),
                        'firstname' => $request->request->get('firstname'),
                        'lastname' => $request->request->get('lastname'),
                        'telephone' => $request->request->get('telephone'),
                        'campagne' => $campagne
                    ];
                    /** @var User $user */
                    $user = $userManager->createUser($datas);
                    $token = new UsernamePasswordToken($user, null, 'main', array('ROLE_USER'));
                    $this->get('security.token_storage')->setToken($token);
                    $this->get('session')->set('_security_main', serialize($token));
                    $emailExists = false;

                    // inscription validée, on balance le mail
                    $campagneManager->sendMailRegister($user, $datas['password']);

                    // si pas de type, on passe directement à la confirmation
                    if ($campagne && !$campagne->getTypeRole()){
                        // si pas de type, on passe directement à la confirmation
                        $campagneManager->sendMailConfirmation(null, $user, $campagne);
                    }


                } else {
                    $emailExists = true;
                }
            } else {
                $user = $userConnected;
            }

            if($emailExists) {
                $retour['success'] = false;
                $retour['message'] = 'Cette adresse e-mail est déjà utilisée !';
            } else {
                if ($user) {
                    $retour['success'] = true;
                    $retour['urlToRedirect'] = $this->generateUrl('inscription', ['type' => $type, 'campagne' => $user->getCampagne()->getId()]);
                } else {
                    $retour['success'] = false;
                    $retour['message'] = 'Impossible de créer votre compte, merci de contacter un administrateur du site';
                }
            }

            return new JsonResponse($retour);
        } else {
            if($user) {

                // condition affichage menu
                $showMenu = $campagneManager->showMenu($campagneReferer);

                if($type == 'testeur') {
                    return $this->render('default/inscription-testeur.html.twig', ['campagne' => $campagneReferer, 'showMenu' => $showMenu]);
                } else if($type == 'tuteur') {
                    return $this->render('default/inscription-tuteur.html.twig', ['campagne' => $campagneReferer, 'showMenu' => $showMenu]);
                } else if($type == 'coach') {
                    return $this->render('default/inscription-coach.html.twig', ['campagne' => $campagneReferer, 'showMenu' => $showMenu]);
                } else if ($type == 'null') {
                    return $this->redirectToRoute('fin_inscription');
                } else {
                    return $this->redirectToRoute('homepage');
                }
            } else {
                return $this->redirectToRoute('homepage');
            }
        }
    }

    /**
     * @Route("/validation", name="inscription_validation")
     */
    public function validateInscriptionAction(Request $request)
    {
        $campagneManager = $this->container->get(CampagneManager::class);

        if($request->isMethod('POST')) {
            $retour = array();
            //$isNewUser = true; // Par défaut c'est un nouveau compte
            $userManager = $this->container->get(UserManager::class);
            $typeUserManager = $this->container->get(TypeUserManager::class);

            $userConnected = $userManager->getUser(); // Retrouve l'user connecté

            $retour['id'] = null;

            if(!$userConnected) {
                $retour['resultat'] = false;
                $retour['message'] = 'Vous devez avoir un compte pour pouvoir créer votre projet !';
            } else {
                $roleSelected = $request->request->get('roleSelected');
                $infosForm = $request->request->get('infosForm');

                // maj campagne
                /** @var Campagne $campagneReferer */
                $campagneReferer = $campagneManager->getCampagneById($infosForm['campagne']);
                $userConnected->setCampagne($campagneReferer);
                $typeUser = $typeUserManager->createType($roleSelected, $infosForm, $userConnected);

                $retour['id'] = $typeUser ? $typeUser->getId() : null;

                $retour['success'] = $campagneManager->sendMailConfirmation($roleSelected, $userConnected, $campagneReferer);

            }
            return new JsonResponse($retour);

        } else {
            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @Route("/fin", name="fin_inscription")
     */
    public function finAction(Request $request)
    {
        $typeUserManager = $this->container->get(TypeUserManager::class);
        $cmsManager = $this->container->get(CmsManager::class);
        $campagneManager = $this->container->get(CampagneManager::class);

        $type = $request->get('type') ? $request->get('type') : 'testeur';
        $typeUser = $typeUserManager->getTypeUser($request->get('id'));
        $campagne = $typeUser->getCampagne();
        $showMenu = $campagneManager->showMenu($campagne);

        $cms = $cmsManager->getPage($type.'_confirmation');

        return $this->render('default/fin.html.twig', array(
                'cms' => $cms,
                'showMenu' => $showMenu,
                'campagne' => $campagne
            )
        );
    }
}
