<?php

namespace Admin;

use AppBundle\Entity\Image;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ImageAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper) : void {
        // get the current Product instance

        /** @var Image $image */
        $image = $this->getSubject();

        // use $fileFieldOptions so we can add other options to the field
        $fileFieldOptions = ['required' => false];
        if ($image && $image->getFileName()) {
            // get the container so the full path to the image can be set

            $fileManager = $this->getConfigurationPool()->getContainer()->get('file_manager');

            $fullPath = $fileManager->getImageUrl($image);

            // add a 'help' option containing the preview's img tag
            $fileFieldOptions['help'] = '<img width="200" height="200" src="' . $fullPath . '" class="admin-preview" />';
        }


        $formMapper
            ->add('productId', TextType::class)
            ->add('isFace', CheckboxType::class)
            ->add('imageFile', FileType::class, $fileFieldOptions)
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $dataGridMapper) : void {
        $dataGridMapper
            ->add('productId')
            ->add('isFace')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) : void {
        $listMapper->addIdentifier('name');
        $listMapper->addIdentifier('productId');
        $listMapper->addIdentifier('isFace');
    }

    /** @param Image $product */
    public function postPersist($product) {
        $this->manageFileUpload($product);
    }

    /** @param Image $product */
    public function preUpdate($product) {
        $this->manageFileUpload($product);
    }

    private function manageFileUpload(Image $image) {
        $file = $image->getFile();

        if ($file) {

            //upload file

            $fileManager = $this->getConfigurationPool()->getContainer()->get('file_manager');
            $fileName = $fileManager->uploadImage($file, $image);
            $image->setFileName($fileName);
        }
    }
}