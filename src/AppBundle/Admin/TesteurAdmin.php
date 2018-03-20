<?php

namespace AppBundle\Admin;

use AppBundle\Entity\CoachUser;
use AppBundle\Entity\TesteurUser;
use AppBundle\Entity\TuteurUser;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;

class TesteurAdmin extends AbstractAdmin
{
    protected $datagridValues = [
        '_sort_by' => 'id',
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->tab('Général')
                ->add('projet', 'textarea', array('label' => 'Description du projet'))
                ->add('immersion_metier','text', array('label' => 'Métier choisi'))
                ->add('immersion_commentaire','textarea', array('label' => 'Commentaire sur le métier', 'required'=>false))
                ->add('disponibilites', 'choice', array('label' => 'Disponibilités', 'choices' => array('Immédiate' => 0, 'Sous 1 à 3 mois' => 1, 'Sous 6 à 12 mois' => 3)))
                ->add('tuteurIdentify', null, array('label' => 'Tuteur identifé'))
                ->add('situation', 'choice', array('label' => 'Situation actuelle', 'choices' => array('Sans emploi' => 1, 'Étudiant' => 2, 'Employé / Ouvrier' => 3, 'Cadre / Manager' => 4, 'Chef d\'entreprise / Indépendant' => 5, 'Retraité' => 6)))
                ->add('birthday', 'sonata_type_date_picker')

                // ajout BO
                ->add('dateFirstContact', 'sonata_type_date_picker', ['help'=> 'Date de 1er échange Téléphone avec le testeur', 'required'=>false])
                ->add('dateRappel', 'sonata_type_date_picker', ['help'=> 'Date de rappel souhaité par le testeur', 'required'=>false, 'label'=>'Date Wish Rappel'])
                ->add('currentMetier', 'text', ['help'=> 'Métier/poste occupé actuellement par le Testeur', 'required'=>false, 'label'=>'Métier Actuel'])
                ->add('competences', 'text', ['help'=> 'Compétences et ce qu’aime le testeur', 'required'=>false])
                ->add('wishStage', 'text', ['help'=> 'Inspirations du testeur : noms d’entreprise ou de tuteurs dans l’idéal. Nom, adresse…', 'required'=>false])
                ->add('wishDuree', 'text', ['help'=> 'Durée de stage souhaitée par le testeur', 'required'=>false])
                ->add('wishGeo', 'text', ['help'=> 'Zone Géo souhaitée par le testeur', 'required'=>false])

            ->end()->end();

        $formMapper
            ->tab('Suivi Dossier')
                ->add('tumCommentaire', 'text', ['help'=> 'Nom du consultant T1M + date d’échange et synthèse/ Commentaires du Consultant T1M ', 'required'=>false])
                ->add('tumLastStatut', 'choice', ['choices' => [
                    'Mur' => 'Mur',
                    'Intéressé' => 'Intéressé',
                    'Pas Mur' => 'Pas Mur',
                    'A Rappeler' => 'A Rappeler',
                    'NO GO' => 'NO GO',
                    'Orienté vers Coaching' => 'Orienté vers Coaching'
                ], 'help'=>'Statut donné au contact suite à l’échange téléphonique.', 'required'=>false, 'label' => 'Tum Last Statut Appel'])
                ->add('tumFinancement', 'choice', ['choices' => [
                    'Tiers' => 'Tiers',
                    'Oui' => 'Oui',
                    'Non' => 'Non'
                ], 'help'=>'Capacité de financement du Testeur', 'required'=>false])
                ->add('consultant', 'text', ['help'=> 'Consultant en charge du suivi de dossier ', 'required'=>false])
                ->add('consultantDate', 'sonata_type_date_picker', ['help'=> 'Date d’appel du consultant pour suivre le dossier', 'required'=>false])
                ->add('consultantCommentaire', 'textarea', ['help'=> 'Nom du consultant + date d’échange et synthèse/ Commentaires du Consultant', 'required'=>false] )
                ->add('tumLastStatutDossier', 'choice', ['choices' => [
                    'No GO' => 'No GO',
                    'Echange tél en attente' => 'Echange tél en attente',
                    '1er appel' => '1er appel',
                    'Envoi de contenu Prospect' => 'Envoi de contenu Prospect',
                    'Mandat de recherche envoyé' => 'Mandat de recherche envoyé',
                    'Mandat de recherche accepté' => 'Mandat de recherche accepté',
                    '1 échange tél Expert' => '1 échange tél Expert',
                    'Proposition de Tutuer' => 'Proposition de Tutuer',
                    'Contrat  envoyé' => 'Contrat  envoyé',
                    'Contract accepté' => 'Contract accepté',
                    'Autre' => 'Autre'
                ], 'help'=>'Statut donné au suivi de dossier ', 'required'=>false])
            ->end()->end();
        $formMapper
            ->tab('Stage')

                ->add('tuteur', 'sonata_type_model_list', [
                    'btn_add' => false
                ])

                ->add('testMetier', 'text', ['help'=> 'Métier testé ', 'required'=>false])
                ->add('testTache', 'text', ['help'=> 'Liste des Taches du Métier à réaliser lors du Test ', 'required'=>false])
                ->add('dateDebut', 'sonata_type_date_picker', ['help'=> 'Date de début du test', 'required'=>false])
                ->add('dateFin', 'sonata_type_date_picker', ['help'=> 'Date de fin du test ', 'required'=>false])
                ->add('testDuree', 'text', ['help'=> 'Durée du test ', 'required'=>false])
                ->add('testTuteurName', 'text', ['help'=> 'Nom du Tuteur ', 'required'=>false])
                ->add('testSocieteName', 'text', ['help'=> 'Société dans lequel se fait le Test', 'required'=>false])
                ->add('testSocieteAdress', 'text', ['help'=> 'Adresse de la Société ', 'required'=>false])
                ->add('testSocieteCodePostal', 'text', ['help'=> 'Code Postal de la Société ', 'required'=>false])
                ->add('testSocieteVille', 'text', ['help'=> 'Ville de la Société ', 'required'=>false])
                ->add('testHoraire', 'text', ['help'=> 'Horaires quotidiens du Test ( de Xh à Xh et de Xh à Xh)', 'required'=>false])
                ->add('testContreIndication', 'text', ['help'=> 'Contre Indication spécifiée par le Tuteur ', 'required'=>false])
                ->add('montant', 'text', ['help'=> 'Montant du Test', 'required'=>false])
                ->add('testIndemnisationTuteur', 'text', ['help'=> 'Indemnisation Journalière demandée par le Tuteur ', 'required'=>false, 'label'=>'Indemnisation Tuteur'])
                ->add('commissionApporteur', 'text', ['help'=> 'Commission Apporteur d’affaire', 'required'=>false])
                ->add('commissionConsultant', 'text', ['help'=> 'Commission Consultant ', 'required'=>false])
                ->add('suiviPaiement', 'text', ['help'=> 'Montant déjà payé par le Testeur ', 'required'=>false])
            ->end()->end();
        $formMapper
            ->tab('Bilan du stage')
                ->add('avisNote', 'integer', ['help'=> 'Note de 1 à 3', 'required'=>false])
                ->add('avis', 'text', ['help'=> 'Verbatim', 'required'=>false])
                ->add('avisPublication', 'checkbox', ['help'=> 'Le testeur autorise la publication de son avis ', 'required'=>false, 'label' => 'Avis Publication Autorisée'])
                ->add('avisConsultant', 'text', ['help'=> 'Commentaires du Consultant sur la réalisation de ce stage.', 'required'=>false])
                ->add('avisAccueil', 'choice', ['choices' => [
                    'super bien' => 'super bien',
                    'normal' => 'normal',
                    'neutre' => 'neutre',
                    'mauvais' => 'mauvais'
                ], 'help'=>'appréciation du testeur sur accueil ', 'required'=>false])
                ->add('avisCorrespond', 'choice', ['choices' => [
                    'Oui totalement' => 'Oui totalement',
                    'oui plutôt' => 'oui plutôt',
                    'Pas vraiment' => 'Pas vraiment'
                ], 'help'=>'appréciation du testeur sur correspond à vos attentes ', 'required'=>false, 'label'=>'Avis Correspond à attentes'])
                ->add('avisCapacite', 'choice', ['choices' => [
                    'Oui totalement' => 'Oui totalement',
                    'oui plutôt' => 'oui plutôt',
                    'Pas vraiment' => 'Pas vraiment'
                ], 'help'=>'appréciation du testeur sur capacité du tuteur à transmettre ', 'required'=>false, 'label'=>'Avis Capacite à transmettre'])
                ->add('avisRecommander', 'checkbox', ['help'=>'Le testeur recommande le Tuteur', 'required'=>false])
                ->add('avisObjectifs', 'checkbox', ['help'=>'Le testeur a atteint ses objectifs', 'required'=>false])
                ->add('avisNextStep', 'choice', ['choices' => [
                    'Trouver une formation' => 'Trouver une formation',
                    'Se lancer dans l’activité' => 'Se lancer dans l’activité',
                    'Réflexion' => 'Réflexion', 'Tester un autre métier' => 'Tester un autre métier',
                    'Abandonner cette idée de métier' => 'Abandonner cette idée de métier'
                ], 'required'=>false])

            ->end()->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('projet', null, array('label' => 'Projet'))
            ->add('immersionMetier', null, array('label' => 'Métier choisi'))
            ->add('immersionCommentaire', null, array('label' => 'Commentaire'))
            ->add('disponibilites', 'doctrine_orm_choice', array('label' => 'Disponibilités'), 'choice', array('multiple' => true, 'choices' => array('Immédiate' => 0, 'Sous 1 à 3 mois' => 1, 'Sous 6 à 12 mois' => 3)))
            ->add('situation', 'doctrine_orm_choice', array('label' => 'Situation actuelle'), 'choice', array('multiple' => true, 'choices' => array('Sans emploi' => 1, 'Étudiant' => 2, 'Employé / Ouvrier' => 3, 'Cadre / Manager' => 4, 'Chef d\'entreprise / Indépendant' => 5, 'Retraité' => 6)))
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
                    'route' => array(
                        'name' => 'edit'
                    ),
                    'label' => 'Utilisateur',
                    'admin_code' => 'admin.user',
                    'query_builder' => function(EntityRepository $er, $current) {
                    return $er->createQueryBuilder('qb')
                        ->join('qb.type_user', 'tu')
                        ->leftJoin('qb.user', 'u')
                        ->where('tu.id', $current->getId())
                        ->where('u.id', 'tu.user_id');
                    }))
            ->add('campagne')
            ->add('tuteur')
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
