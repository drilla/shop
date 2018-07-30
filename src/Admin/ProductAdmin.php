<?php

namespace Admin;

use AppBundle\Entity\Product;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper) : void {
        $formMapper
            ->add('name', TextType::class)
            ->add('price', TextType::class)
            ->add('category', TextType::class)
            ->add('description', TextType::class)
            ->add('imageFile', FileType::class)
        ;

//        $builder = $formMapper->getFormBuilder();
//        $builder->setDataMapper(new ProductMapper());
    }

    protected function configureDatagridFilters(DatagridMapper $dataGridMapper) : void {
        $dataGridMapper
            ->add('name')
            ->add('price')
            ->add('category')
            ->add('description')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) : void {
        $listMapper->addIdentifier('name');
        $listMapper->addIdentifier('price');
        $listMapper->addIdentifier('category');
        $listMapper->addIdentifier('description');
    }

    /** @param Product $product */
    public function prePersist($product) {
        $this->manageFileUpload($product);
    }

    /** @param Product $product */
    public function preUpdate($product) {
        $this->manageFileUpload($product);
    }

    private function manageFileUpload(Product $product)
    {
        if ($product->getImageFile()) {
            //upload file

            $product->setPicture($fileName);
        }
    }
}