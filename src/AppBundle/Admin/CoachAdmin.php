<?php

namespace AppBundle\Admin;

use AppBundle\Entity\CoachUser;
use AppBundle\Entity\TesteurUser;
use AppBundle\Entity\TuteurUser;
use Doctrine\ORM\EntityRepository;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CoachAdmin extends AbstractAdmin
{
    protected $datagridValues = [
        '_sort_by' => 'id',
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('user', 'sonata_type_model_list', [
                'btn_add' => false
            ], ['admin_code' => 'admin.user'])
            ->add('motif', 'choice', array('label' => 'Motif sélectionné', 'choices' => array('Avenir professionnel' => 1, 'Bilan de carrière' => 2, 'Création d\'entreprise' => 3, 'Recerche d\'un nouveau métier' => 4, 'Autres' => 5)))
            ->add('demande','textarea', array('label' => 'Description de la demande'))
            ->add('disponibilites', 'choice', array('label' => 'Disponibilités', 'choices' => array('Immédiate' => 0, 'Sous 1 à 3 mois' => 1, 'Sous 6 à 12 mois' => 3)))
            ->add('situation', 'choice', array('label' => 'Situation actuelle', 'choices' => array('Sans emploi' => 1, 'Étudiant' => 2, 'Employé / Ouvrier' => 3, 'Cadre / Manager' => 4, 'Chef d\'entreprise / Indépendant' => 5, 'Retraité' => 6)))
            ->add('birthday', 'sonata_type_date_picker')

            // ajout BO
            ->add('dateFirstContact', 'sonata_type_date_picker', array('help'=>'date de 1er Contact Téléphone', 'required'=>false))
            ->add('dateRappel', 'sonata_type_date_picker', array('help'=>'Date de rappel souhaité par le Coaché', 'required'=>false, 'label'=>'Date Wish Rappel'))
            ->add('consultant', 'text', array('help' => 'Nom du Consultant en charge du suivi'))
            ->add('tumCommentaires', null, ['help'=>'Nom du consultant + date d’échange et synthèse/ Commentaires du Consultant T1M ', 'required'=>false])
            ->add('tumLastStatut','choice', array('label'=>'Tum Last Statut Appel', 'help'=>'Statut suite à l\'échange téléphonique', 'choices' => array('Interessé' => 'Interessé', 'A Rappeler' => 'A Rappeler', 'NO GO' => 'NO GO', 'Mur' => 'Mur', 'Pas Mur' => 'Pas Mur', 'Orienté vers Coaching' => 'Orienté vers Coaching'), 'required'=>false))
            ->add('tumFinancement', 'choice', ['help'=>'pourrait financer son coaching ou ne veut pas payer ', 'choices' => ['Tiers'=>'Tiers', 'Oui'=>'Oui', 'Non'=>'Non'],'required'=>false])
            ->add('tumStatutCoaching')

            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('motif', 'doctrine_orm_choice', array('label' => 'Motif'), 'choice', array('choices' => array('Avenir professionnel' => 1, 'Bilan de carrière' => 2, 'Création d\'entreprise' => 3, 'Recerche d\'un nouveau métier' => 4, 'Autres' => 5), 'multiple' => true))
            ->add('demande', null, array('label', 'Description de la demande'))
            ->add('createdAt', 'doctrine_orm_datetime', array('field_type'=>'sonata_type_date_picker'))
            ->add('user.lastname', null, array('label' => 'Nom'))
            ->add('user.firstname', null, array('label' => 'Prénom'))
            ->add('user.email', null, array('label' => 'Email'));
    }

    protected function configureListFields(ListMapper $listMapper)
    {

        $current = $this->getSubject();

        $listMapper->addIdentifier('user.id')
            ->add('user', 'sonata_type_model',
                array(
                    'label' => 'Utilisateur',
                    'admin_code' => 'admin.user',
                    'query_builder' => function(EntityRepository $er, $current) {
                        return $er->createQueryBuilder('qb')
                            ->join('qb.type_user', 'tu')
                            ->leftJoin('qb.user', 'u')
                            ->where('tu.id', $current->getId())
                            ->where('u.id', 'tu.user_id');
                    }))
            ->add('createdAt')
            ->add('_action', null, array(
                'label' => "Actions",
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ));
    }

    public function prePersist($object)
    {

    }
}
