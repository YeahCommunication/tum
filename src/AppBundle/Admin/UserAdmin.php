<?php

namespace AppBundle\Admin;

use AppBundle\Entity\CoachUser;
use AppBundle\Entity\TesteurUser;
use AppBundle\Entity\TuteurUser;
use AppBundle\Entity\TypeUser;
use Doctrine\ORM\EntityRepository;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UserAdmin extends AbstractAdmin
{
    protected $datagridValues = [
        '_sort_by' => 'id',
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $user = $this->getSubject();

        $formMapper
            ->tab('Général')
                ->add('gender', 'choice', array('choices' => array('Male' => 'm', 'Female' => 'f')))
                ->add('firstname')
                ->add('lastname')
                ->add('email')
                ->add('telephone')
                ->add('postalCode')

                // ajout BO
                ->add('adresse', null, ['label' => 'Adresse'])
                ->add('ville')
                ->add('telephone')
                ->add('visibilite', 'choice', ['required'=>false, 'choices' => ['Bouche à Oreille'=>'Bouche à Oreille', 'Média'=>'Média', 'Réseau sociaux'=>'Réseau sociaux', 'Recherche Internet'=>'Recherche Internet', 'Mon entreprise DRH'=>'Mon entreprise DRH', 'Autre'=>'Autre'], 'label' => 'Visibilité T1M', 'help' => 'Comment avez-vous connu T1M ?'])
                ->add('visibiliteAutre', null, ['label' => 'Visibilité T1M Autre'])

                ->add('plainPassword', 'text', array(
                    'required' => (!$this->getSubject() || is_null($this->getSubject()->getId())),
                    'label' => 'Mot de passe',
                ))
                ->add('roles', 'choice', array(
                    'choices' => array(
                        'SUPER Admin' => 'ROLE_SUPER_ADMIN',
                        'Admin' => 'ROLE_ADMIN'
                    ),
                    'label' => 'droits admin',
                    'expanded' => false,
                    'multiple' => true,
                    'required' => false
                ))
            ->end()
            ->end();

        $types = $user->getTypes();

        foreach($types as $type) {
            if($type instanceof TesteurUser) {
                $user->testeur = $type;
                $formMapper->tab('Testeur')
                    ->add('testeur.projet', 'textarea', array('label' => 'Description du projet'))
                    ->add('testeur.immersion_metier','text', array('label' => 'Métier choisi'))
                    ->add('testeur.immersion_commentaire','textarea', array('label' => 'Commentaire sur le métier'))
                    ->add('testeur.disponibilites', 'choice', array('label' => 'Disponibilités', 'choices' => array('Immédiate' => 0, 'Sous 1 à 3 mois' => 1, 'Sous 6 à 12 mois' => 3)))
                    ->add('testeur.tuteurIdentify', 'checkbox', array('label' => 'Tuteur identifé'))
                    ->add('testeur.situation', 'choice', array('label' => 'Situation actuelle', 'choices' => array('Sans emploi' => 1, 'Étudiant' => 2, 'Employé / Ouvrier' => 3, 'Cadre / Manager' => 4, 'Chef d\'entreprise / Indépendant' => 5, 'Retraité' => 6)))
                    ->add('testeur.birthday', 'birthday')
                    ->end()->end();
            }

            if($type instanceof TuteurUser) {
                $user->tuteur = $type;
                $formMapper->tab('Tuteur')
                ->add('tuteur.motivations', 'textarea', array('label' => 'Motivations'))
                ->add('tuteur.immersion_metier', 'text', array('label' => 'Métier d\'insertion proposé'))
                ->add('tuteur.immersionCommentaire','textarea', array('label' => 'Commentaire sur le métier'))
                ->add('tuteur.type_remuneration', 'choice', array('label' => 'Rémunération choisie', 'choices' => array('Nécessite une proposition de Testunmetier.com' => 1, 'Remuneration définie pour 1 journée' => 2)))
                ->add('tuteur.ammount_remuneration', 'number', array('label' => 'Rémunération définie pour 1 journée'))
                ->add('tuteur.duree_testeur', 'choice', array('label' => 'Durée choisie', 'choices' => array('De 1 à 5 jours' => 1, 'De 5 à 10 jours' => 2, 'Plus de 10 jours' => 3)))
                ->add('tuteur.commentaires', 'textarea', array('label' => 'Commentaires'))
                ->add('tuteur.agencyName','text')
                ->add('tuteur.agencyAddress','text')
                ->add('tuteur.agencyAddress2','text')
                ->add('tuteur.agencyPostalcode','text')
                ->add('tuteur.agencyCity','text')
                ->add('tuteur.agencyNb','text')
                ->end()->end();
            }

            if($type instanceof CoachUser) {
                $user->coach = $type;
                $formMapper->tab('Coach')
                    ->add('coach.motif', 'choice', array('label' => 'Motif sélectionné', 'choices' => array('Avenir professionnel' => 1, 'Bilan de carrière' => 2, 'Création d\'entreprise' => 3, 'Recerche d\'un nouveau métier' => 4, 'Autres' => 5)))
                    ->add('coach.demande','textarea', array('label' => 'Description de la demande'))
                    ->add('coach.disponibilites', 'choice', array('label' => 'Disponibilités', 'choices' => array('Immédiate' => 0, 'Sous 1 à 3 mois' => 1, 'Sous 6 à 12 mois' => 3)))
                    ->add('coach.situation', 'choice', array('label' => 'Situation actuelle', 'choices' => array('Sans emploi' => 1, 'Étudiant' => 2, 'Employé / Ouvrier' => 3, 'Cadre / Manager' => 4, 'Chef d\'entreprise / Indépendant' => 5, 'Retraité' => 6)))
                    ->add('coach.birthday', 'birthday')
                    ->end()->end();
            }
        }

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('firstname', null, array('label' => 'Prénom'))
            ->add('lastname', null, array('label' => 'Nom'))
            ->add('email', null, array('label' => 'E-mail'))
            ->add('telephone', null, array('label' => 'Téléphone'))
            ->add('enabled', null, array('label' => 'Actif'))
            ->add('types', null, array('label' => 'Type'))
            ->add('createdAt', 'doctrine_orm_datetime', array('field_type'=>'sonata_type_date_picker'))
            ->add('lastLogin', 'doctrine_orm_datetime', array('field_type'=>'sonata_type_date_picker'));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('oldId', null, ['label'=>'Ancien ID']);
        $listMapper->addIdentifier('firstname');
        $listMapper->addIdentifier('lastname')
            ->add('telephone')
            ->add('email')
            ->add('campagne')
            ->add('createdAt')
            ->add('lastLogin');
    }

    public function prePersist($object)
    {

    }
}
