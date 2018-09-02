<?php

namespace Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @author drilla
 */
class StreamAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper) : void {
        $formMapper
            ->add('streamId', TextType::class)
            ->add('product', ModelType::class, ['property' => 'name'])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $dataGridMapper) : void {
        $dataGridMapper
            ->add('product', 'doctrine_orm_model_autocomplete' , [], null, ['property'=>'title'] )
        ;
    }

    protected function configureListFields(ListMapper $listMapper) : void {
        $listMapper
            ->addIdentifier('product', null, ['associated_property' => 'name'])
            ->add('streamId', 'text', ['editable' => true])
        ;
    }
}