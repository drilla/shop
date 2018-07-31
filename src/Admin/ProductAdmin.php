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
        // get the current Product instance

//        /** @var Product $product */
//        $product = $this->getSubject();
//
//        // use $fileFieldOptions so we can add other options to the field
//        $fileFieldOptions = ['required' => false];
//        if ($product && $product->getPicture()) {
//            // get the container so the full path to the image can be set
//
//            $fileManager = $this->getConfigurationPool()->getContainer()->get('file_manager');
//
//            $fullPath =  $fileManager->getImageUrl($product);
//
//            // add a 'help' option containing the preview's img tag
//            $fileFieldOptions['help'] = '<img width="200" height="200" src="'.$fullPath.'" class="admin-preview" />';
//        }


        $formMapper
            ->add('name', TextType::class)
            ->add('price', TextType::class)
            ->add('category', TextType::class)
            ->add('description', TextType::class)
//            ->add('imageFile', FileType::class, $fileFieldOptions)
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

//    /** @param Product $product */
//    public function postPersist($product) {
//        $this->manageFileUpload($product);
//    }
//
//    /** @param Product $product */
//    public function preUpdate($product) {
//        $this->manageFileUpload($product);
//    }
//
//    private function manageFileUpload(Product $product) {
//        $file = $product->getImageFile();
//
//        if ($file) {
//
//            //upload file
//
//            $fileManager = $this->getConfigurationPool()->getContainer()->get('file_manager');
//            $fileName = $fileManager->uploadImage($file, $product);
//            $product->setPicture($fileName);
//        }
//    }
}