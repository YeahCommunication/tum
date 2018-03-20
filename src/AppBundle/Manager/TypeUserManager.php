<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 30/12/2017
 * Time: 15:02
 */

namespace AppBundle\Manager;


use AppBundle\Entity\CoachUser;
use AppBundle\Entity\TesteurUser;
use AppBundle\Entity\TuteurUser;
use AppBundle\Entity\TypeUser;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class TypeUserManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $role
     * @param array $datas
     * @param User $user
     * @return TypeUser
     */
    public function createType($role, array $datas, User $user)
    {
        if($role === 'testeur') {
            $typeUser = new TesteurUser();
            $typeUser->setBirthday(new \DateTime($datas['birthdayString']));
            $typeUser->setDisponibilites($datas['disponibilites']);
            $typeUser->setImmersionMetier($datas['immersion_metier']);
            $typeUser->setImmersionCommentaire($datas['immersion_commentaire']);
            $typeUser->setProjet($datas['projet']);
            $typeUser->setSituation($datas['situation']);
            $typeUser->setTuteurIdentify($datas['tuteur_identify']);

        } else if($role === 'coach') {
            $typeUser = new CoachUser();
            $typeUser->setDemande($datas['demande']);
            $typeUser->setMotif($datas['motif']);
            $typeUser->setDisponibilites($datas['disponibilites']);
            $typeUser->setBirthday(new \DateTime($datas['birthdayString']));
            $typeUser->setSituation($datas['situation']);

        } else if($role === 'tuteur') {
            $typeUser = new TuteurUser();
            $typeUser->setImmersionMetier($datas['immersion_metier']);
            $typeUser->setImmersionCommentaire($datas['immersion_commentaire']);
            $typeUser->setSituation($datas['situation']);
            $typeUser->setDisponibilites($datas['disponibilites']);
            $typeUser->setDureeTesteur($datas['disponibilites']);
            $typeUser->setTypeRemuneration($datas['type_remuneration']);

            $typeUser->setAgencyName($datas['agency_name']);
            $typeUser->setAgencyAddress($datas['agency_address']);
            $typeUser->setAgencyAddress2($datas['agency_address2']);
            $typeUser->setAgencyPostalcode($datas['agency_postalcode']);
            $typeUser->setAgencyCity($datas['agency_city']);
            $typeUser->setAgencyNb($datas['agency_nb']);


            if($datas['type_remuneration'] == 2) {
                $typeUser->setAmmountRemuneration($datas['ammount_remuneration']);
            } else {
                $typeUser->setAmmountRemuneration(0);
            }
            $typeUser->setDureeTesteur(0);
            $typeUser->setMotivations($datas['motivations']);
            $typeUser->setCommentaires($datas['commentaires']);

        } else {
            $typeUser = false;
        }

        if($typeUser) {
            $user->addType($typeUser);

            $typeUser->setCampagne($user->getCampagne());

            $this->entityManager->persist($typeUser);
            $this->entityManager->persist($user);

            $this->entityManager->flush();
        } else {
            $typeUser = false;
        }

        return $typeUser;
    }

    /**
     * @param $id
     * @return TypeUser
     */
    public function getTypeUser($id){

        $repo = $this->entityManager->getRepository(TypeUser::class);

        /** @var TypeUser $typeUser */
        $typeUser =  $repo->find($id);

        return $typeUser;
    }
}