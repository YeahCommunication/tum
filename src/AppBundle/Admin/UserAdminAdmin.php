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
                ->add('roles', 'choice', array(
                    'choices' => array(
                        'SUPER Admin' => 'ROLE_SUPER_ADMIN',
                        'Admin' => 'ROLE_ADMIN'
                    ),
                    'expanded' => false,
                    'multiple' => true,
                    'required' => false
                ))
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
            ->add('_action', null, array(
                'label' => "Actions",
                'actions' => array(
                    'edit' => array(),
                )
            ));
    }

}
