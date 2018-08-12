<?php

namespace Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;

/**
 *  @author drilla
 */
class OrderAdmin extends AbstractAdmin
{
    public function configureFormFields(FormMapper $form) {
        $form
            ->add('product', ModelType::class, ['property' => 'name'])
            ->add('name')
            ->add('phone')
            ->add('count')
            ->add('comment')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $dataGridMapper) : void {
        $dataGridMapper
            ->add('id')
            ->add('product', 'doctrine_orm_model_autocomplete'  ,[], null, ['property'=>'name'] )
            ->add('name')
            ->add('phone')
            ->add('count')
            ->add('comment')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) : void {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('product', null, ['associated_property' => 'name']);
        $listMapper->addIdentifier('name');
        $listMapper->addIdentifier('phone');
        $listMapper->addIdentifier('count');
        $listMapper->addIdentifier('comment');
    }
}