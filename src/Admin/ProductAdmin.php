<?php

namespace Admin;

use AppBundle\Helper\Product as ProductHelper;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * @author drilla
 */
class ProductAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper) : void {
        $formMapper
            ->add('name', TextType::class)
            ->add('slug', TextType::class)
            ->add('price', TextType::class)
            ->add('fakePrice', TextType::class, ['required' => false,])
            ->add('category', ChoiceType::class, ['choices' => array_flip(ProductHelper::categoryLabels())])
            ->add('isDefault', CheckboxType::class, ['required' => false,])
            ->add('rate', TextType::class)
            ->add('rateCount', TextType::class)
            ->add('description', TextType::class)
            ->add('consist', CKEditorType::class)
            ->add('article', CKEditorType::class)
        ;

    }

    protected function configureDatagridFilters(DatagridMapper $dataGridMapper) : void {
        $dataGridMapper
            ->add('name')
            ->add('slug')
            ->add('price')
            ->add('category')
            ->add('description')
            ->add('isDefault')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) : void {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('name')
            ->add('slug', 'text', ['editable' => true])
            ->add('price', 'text', ['editable' => true])
            ->add('rate', 'text', ['editable' => true])
            ->add('rateCount', 'text', ['editable' => true])
            ->add('fakePrice', 'text', ['editable' => true])
            ->add('isDefault', null, ['editable' => true])
            ->add('category', 'choice', [
                    'choices'  => ProductHelper::categoryLabels(),
                    'editable' => true,
                ]
            )
            ->add('description');
    }
}