<?php

namespace AppBundle\Admin;

use AppBundle\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdminAdmin extends AbstractAdmin
{

    protected $baseRouteName = 'admin_app_user_admin';
    protected $baseRoutePattern = 'app/user_admin';

    protected $datagridValues = [
        '_sort_by' => 'nom',
    ];

    public function createQuery($context = 'list')
    {

        /** @var QueryBuilder $query */
        $query = parent::createQuery();
        $query->andWhere($query->getRootAlias().'.roles LIKE :roles')
            ->setParameter('roles', '%ROLE_%');
        return $query;
    }

    protected static function flattenRoles($rolesHierarchy)
    {
        $flatRoles = array();
        foreach($rolesHierarchy as $roles) {

            if(empty($roles)) {
                continue;
            }

            foreach($roles as $role) {
                if(!isset($flatRoles[$role])) {
                    $flatRoles[$role] = $role;
                }
            }
        }

        return $flatRoles;
    }

    /**
     * @param User $object
     * {@inheritdoc}
     */
    public function prePersist($object)
    {
        $object->setEnabled(true);
        //$object->addRole('ROLE_SUPER_ADMIN');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Administrateur')
            ->with('General', array('class' => 'col-md-6'))
                ->add('gender', 'choice', array('choices' => array('Male' => 'm', 'Female' => 'f')))
                ->add('lastname')
                ->add('firstname')
                ->add('email')
                ->add('telephone')
                ->add('plainPassword', 'text', array(
                    'required' => (!$this->getSubject() || is_null($this->getSubject()->getId())),
                    'label' => 'Mot de passe',
                ))
                ->end()
            ->with('Roles', array('class' => 'col-md-6'))
                ->add('roles', 'choice', array(
                    'choices' => array(
                        'SUPER Admin (accès complet)' => 'ROLE_SUPER_ADMIN',
                        'Etablissement' => 'ROLE_ETABLISSEMENT',
                        'Client' => 'ROLE_CLIENT',
                        'Leads' => 'ROLE_LEADS',
                        'BCA' => 'ROLE_BCA',
                        'Stock' => 'ROLE_STOCK',
                        'Contenu' => 'ROLE_CONTENU',
                        'Jobs' => 'ROLE_JOBS',
                        'Entretenir' => 'ROLE_ENTRETENIR',
                    ),
                    'label' => 'Accès aux menus',
                    'expanded' => false,
                    'multiple' => true,
                    'required' => false
                ))
                ->add('adminEtab')
                ->end()

            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('lastname')
            ->add('firstname');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('lastname')
            ->add('firstname')
            ->add('email')
            ->add('roles', 'array', array('template' => 'Admin/CRUD/role.html.twig'));
    }

}
