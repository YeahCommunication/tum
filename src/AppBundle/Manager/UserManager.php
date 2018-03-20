<?php

namespace AppBundle\Manager;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class UserManager
{
    private $entityManager;
    private $fosUserManager;
    private $tokenStorage;
    private $authorizationChecker;

    public function __construct(EntityManagerInterface $entityManager, UserManagerInterface $fosUserManager, TokenStorageInterface $tokenStorage, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->entityManager = $entityManager;
        $this->fosUserManager = $fosUserManager;
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @param array $datas formulaire
     * @return User
     */
    public function createUser(array $datas)
    {
        /** @var User $user */
        $user = $this->fosUserManager->createUser();

        $user->setEmail($datas['email'])
            ->setPlainPassword($datas['password'])
            ->setGender($datas['gender'])
            ->setPostalCode($datas['postal_code'])
            ->setFirstname($datas['firstname'])
            ->setLastname($datas['lastname'])
            ->setTelephone($datas['telephone'])
            ->setCampagne($datas['campagne'])
            ->setEnabled(true);

        $this->fosUserManager->updateUser($user);

        return $user;
    }

    /**
     * @param User $user
     * @param Request $request
     */
    public function updateUser(User $user, Request $request)
    {
        $user->setFirstName($request->request->get('firstname'))
            ->setLastName($request->request->get('lastname'))
            ->setPostalCode($request->request->get('postalCode'))
            ->setTelephone($request->request->get('telephone'));

        $this->fosUserManager->updateUser($user);
    }

    /**
     * @param string $email
     * @return User $user
     */
    public function findUserByEmail($email)
    {
        $reposUser = $this->entityManager->getRepository(User::class);
        $user = $reposUser->findOneBy(array('email' => $email));

        return $user;
    }

    /**
     * @return User|null
     */
    public function getUser()
    {
        return false !== $this->authorizationChecker->isGranted('ROLE_USER') ? $this->tokenStorage->getToken()->getUser() : null;
    }
}