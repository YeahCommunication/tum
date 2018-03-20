<?php

namespace AppBundle\Admin;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CmsItemAdmin extends AbstractAdmin
{

    /**
     * Configure the form
     *
     * @param FormMapper $formMapper formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $label = $this->getSubject() ? $this->getSubject()->getName() : '';

        $formMapper->add('content', CKEditorType::class, array(
            'label' => $label,
            'by_reference' => false,
            'config' => array('uiColor' => '#ffffff'),
            'required' => false
        ));
    }
}
