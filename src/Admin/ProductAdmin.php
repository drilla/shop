<?php

namespace Admin;

use AppBundle\Form\Mapper\ProductMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper) : void {
        $formMapper
            ->add('name', TextType::class)
            ->add('price', TextType::class)
            ->add('description', TextType::class)
        ;

        $builder = $formMapper->getFormBuilder();
        $builder->setDataMapper(new ProductMapper());
    }

    protected function configureDatagridFilters(DatagridMapper $dataGridMapper) : void {
        $dataGridMapper
            ->add('name')
            ->add('price')
            ->add('description')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) : void {
        $listMapper->addIdentifier('name');
        $listMapper->addIdentifier('price');
        $listMapper->addIdentifier('description');
    }
}