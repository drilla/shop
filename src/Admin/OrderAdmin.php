<?php

namespace Admin;

use AppBundle\Entity\Product;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
            ->add('ip')
            ->add('isSent')
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
            ->add('isSent')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) : void {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('product', null, ['associated_property' => 'name'])
            ->add('name')
            ->add('phone')
            ->add('ip')
            ->add('count')
            ->add('comment')
            ->add('isSent')
        ;
    }
}