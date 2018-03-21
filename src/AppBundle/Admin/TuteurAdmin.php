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

class TuteurAdmin extends AbstractAdmin
{
    protected $datagridValues = [
        '_sort_by' => 'id',
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Général')
                ->add('user', 'sonata_type_model_list', [
                    'btn_add' => false
                ], ['admin_code' => 'admin.user'])
                ->add('motivations', 'textarea', array('label' => 'Motivations'))
                ->add('immersion_metier', 'text', array('label' => 'Métier d\'insertion proposé'))
                ->add('immersion_commentaire','textarea', array('label' => 'Commentaire sur le métier', 'required'=>false))
                ->add('situation','choice', array('choices' => array('Indépendant' => 1, 'Salarié' => 2, 'Chef d\'entreprise' => 3)))
                ->add('type_remuneration', 'choice', array('label' => 'Rémunération choisie', 'choices' => array('A titre gracieux' => 1, 'Remuneration définie pour 1 journée' => 2)))
                ->add('ammount_remuneration', 'number', array('label' => 'Rémunération définie pour 1 journée'))
                ->add('duree_testeur', 'choice', array('label' => 'Durée choisie', 'choices' => array('De 1 à 5 jours' => 1, 'De 5 à 10 jours' => 2, 'Plus de 10 jours' => 3)))
                ->add('commentaires', 'textarea', array('label' => 'Commentaires', 'required'=>false))

                ->add('agencyName')
                ->add('agencyAddress')
                ->add('agencyAddress2')
                ->add('agencyPostalcode')
                ->add('agencyCity')
                ->add('agencyNb')

                // ajout BO
                ->add('raisonSociale', 'text', ['label'=>'raison sociale', 'required'=>false])
                ->add('siret', 'text', ['label'=>'numéro de SIRET', 'required'=>false])
                ->add('capitalSocial', 'text', ['label'=>'capital social', 'required'=>false])
                ->add('representantLegal', 'text', ['label'=>'représentant légal', 'required'=>false])
                ->add('metierList', 'textarea', ['help'=>'le/les métier/s que vous pouvez faire tester (ex : métier 1/ métier 2/métier 3…)', 'required'=>false])
                ->add('metier2', 'text', ['help'=>'Metier secondaire ', 'required'=>false])
                ->add('tache2', 'text', ['help'=>'Listes des taches du Métier secondaire ', 'required'=>false])
                ->add('contreIndication', 'text', ['help'=>'contre indication absolue du testeur (ex : fumeur)', 'required'=>false])
                ->add('horaires', 'text', ['help'=>'horaires quotidiens (de Xh à Xh et de Xh à Xh )', 'required'=>false])
                ->add('secteur', 'text', ['help'=>'Secteur d’activité du Testeur ', 'required'=>false])
                ->add('appAffaire', 'text', ['label'=>'Apporteur d’Affaire ', 'required'=>false])
                ->add('consultant', 'text', ['label'=>'Consultant référent du Tuteur ', 'required'=>false])

                ->add('tumLastStatut', 'choice', ['choices' => [
                    'Tuteur potentiel (fiche créé)' => 'Tuteur potentiel (fiche créé)',
                    'Tuteur engagé (entretien fait et OK pour accueillir stagiaire)' => 'Tuteur engagé (entretien fait et OK pour accueillir stagiaire)',
                    'Tuteur Actif (a reç un testeur)' => 'Tuteur Actif (a reç un testeur)',
                    'Tuteur inactif (Ne souhaite pas plus être Tuteur)' => 'Tuteur inactif (Ne souhaite pas plus être Tuteur)'
                ], 'help'=>'Dernier Statut donnée au suivi du contact Tuteur', 'required'=>false])

                ->add('dateFirstContact', 'sonata_type_date_picker', ['help'=>'Date de rappel souhaité par le Tuteur ', 'required'=>false])
                ->add('dateRappel', 'sonata_type_date_picker', ['help'=>'Dernier Statut donné au suivi du contact Tuteur ', 'required'=>false, 'label'=>'Date Wish Rappel'])
                ->add('tumCommentaires', 'text', ['label'=>'Commentaires du Consultant sur le Tuteur ', 'required'=>false])

            ->end()->end();

        $formMapper
            ->tab('Expérience de Stage')
                ->add('avisTuteur', 'text', ['help'=>'verbatim', 'required'=>false])
                ->add('avisTuteurPublication', 'checkbox', ['help'=>'Le tuteur autorise la publication de son avis ', 'required'=>false])
                ->add('avisAccompagnement', 'text', ['help'=>'Commentaires du Consultant T1M sur le Tuteur', 'required'=>false])
                ->add('avisTuteur', 'text', ['help'=>'appréciation du tuteur sur T1M', 'required'=>false])
                ->add('avisExperience', 'checkbox', ['help'=>'Envisagez-vous de renouveler l’expérience ', 'required'=>false])


            ->end()->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('motivations', null, array('label' => 'Motivations'))
            ->add('immersionMetier', null, array('label' => 'Métier proposé'))
            ->add('disponibilites', 'doctrine_orm_choice', array('label' => 'Disponibilités'), 'choice', array('choices' => array('Immédiate' => 0, 'Sous 1 à 3 mois' => 1, 'Sous 6 à 12 mois' => 3), 'multiple' => true))
            ->add('typeRemuneration', 'doctrine_orm_choice', array('label' => 'Type de rémunération choisi'), 'choice', array('choices' => array('Nécessite une proposition de Testunmetier.com' => 1, 'Remuneration définie pour 1 journée' => 2), 'multiple' => true))
            ->add('ammountRemuneration', null, array('label' => 'Montant de la rémunération'))
            ->add('dureeTesteur', 'doctrine_orm_choice', array('label' => 'Durée choisie'), 'choice', array('choices' => array('De 1 à 5 jours' => 1, 'De 5 à 10 jours' => 2, 'Plus de 10 jours' => 3), 'multiple' => true))
            ->add('commentaires', null, array('label' => 'Commentaires'))
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
