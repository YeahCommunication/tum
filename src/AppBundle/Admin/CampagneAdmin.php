<?php

namespace AppBundle\Admin;


use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CampagneAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {

        // get the current instance
        $campagne = $this->getSubject();

        // use $fileFieldOptions so we can add other options to the field
        $visuelFileFieldOptions = ['label' => 'Visuel qui sera sur la gauche', 'required' => false, 'help' => 'taille : 555px/555px'];
        if ($campagne && ($webPath = $campagne->getVisuel())) {
            // get the container so the full path to the image can be set
            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = $container->get('request_stack')->getCurrentRequest()->getBasePath().'/uploads/images/campagnes/visuels/'.$webPath;

            // add a 'help' option containing the preview's img tag
            $visuelFileFieldOptions['help'] = '<img width="100px" height="100px" src="'.$fullPath.'" class="admin-preview" /><br>taille : 555px/555px';
        }

        $logoFileFileFieldOptions = ['label' => 'Logo qui sera en haut de page', 'required' => false, 'help' => 'taille : 65px/65px'];

        if ($campagne && ($webPath = $campagne->getLogo())) {
            // get the container so the full path to the image can be set
            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = $container->get('request_stack')->getCurrentRequest()->getBasePath().'/uploads/images/campagnes/logos/'.$webPath;

            // add a 'help' option containing the preview's img tag
            $logoFileFileFieldOptions['help'] = '<img width="65px" height="65px" src="'.$fullPath.'" class="admin-preview" /><br>taille : 65px/65px';
        }


        $formMapper->add('libelle', null, array('label' => 'Libellé'))
            ->add('slug', null, array('label' => 'URL', 'required' => false, 'help' => '/campagne/XXXXX.html'))
            ->add('typeRole', 'choice', array('required' => false, 'label' => 'Type d\'inscription associée', 'choices' => array('Testeur' => '1', 'Tuteur' => '2', 'Coach' => '3')))
            ->add('logoFile', 'file', $logoFileFileFieldOptions)
            ->add('visuelFile', 'file', $visuelFileFieldOptions)
            ->add('codeHtml', CKEditorType::class, array('required' => false, 'attr' => array('class' => 'ckeditor')))
            ->add('codeCss', 'textarea', array('required' => false, 'attr' => array('rows' => 15)))
            ->add('confirmMail', CKEditorType::class, array('label'=>'Mail de confirmation', 'required' => false, 'attr' => array('class' => 'ckeditor')))
            ->add('confirmText', CKEditorType::class, array('label'=>'Message de confirmation', 'required' => false, 'attr' => array('class' => 'ckeditor')))
            ->end();
    }

    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper->addIdentifier('id')
            ->addIdentifier('libelle', null, ['label'=>'Nom'])
            ->add('typeRole', 'choice', array('required' => false, 'label' => 'Type d\'inscription associée', 'choices' => array(1 => 'Testeur', 2 => 'Tuteur', 3 => 'Coach') ))
            ->add('createdAt')
            ->add('_action', null, array(
                'label' => "Actions",
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ));

    }
}