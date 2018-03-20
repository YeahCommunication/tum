<?php

namespace AppBundle\Admin;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CmsAdmin extends AbstractAdmin
{
    protected $datagridValues = [
        '_sort_by' => 'name',
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->tab('Textes');

        $formMapper
            ->add('value', 'collection', array(
                'label' => false,
                'required' => false
            ))
            ->add('items', 'sonata_type_collection', array(
                'required'=>false,
                'label' => false,
                'by_reference' => false,
                'type_options' => array(
                    // Prevents the "Delete" option from being displayed
                    'delete' => false,
                    'delete_options' => array(
                        // You may otherwise choose to put the field but hide it
                        'type'         => 'hidden',
                        // In that case, you need to fill in the options as well
                        'type_options' => array(
                            'mapped'   => false,
                            'required' => false,
                        )
                    ))
            ), array(
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position'
            ));
    }

    public function getFormTheme() {
        return array('Admin/form_admin_fields.html.twig');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
    }

    public function checkAccess($action, $object = null)
    {
        if (!in_array($action, ['list', 'show', 'export', 'edit'])) {
            throw new AccessDeniedException();
        }

        parent::checkAccess($action, $object);
    }

    public function prePersist($object)
    {
        $object->setSeo(array('img_title'=>'', 'img_alt'=>'', 'title'=>''));

        /*
        $object->setAlias('test');
        $object->setState(true);
        */
    }
}
