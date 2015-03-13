<?php

namespace ESGI\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends Admin
{
    protected function configureRoutes(\Sonata\AdminBundle\Route\RouteCollection $collection) 
    {
        $collection->remove('create');
    }
    
    // Fields to be shown on create/edit 
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username', 'text')
            ->add('firstname','text') 
            ->add('lastname', 'text')
            ->add('email')
            ->add('roles')
            ->add('enabled')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username')
            ->add('firstname')
            ->add('lastname')
            ->add('email')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username')
            ->add('firstname')
            ->add('lastname')
            ->add('email')
        ;
    }
}