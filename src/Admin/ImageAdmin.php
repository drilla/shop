<?php

namespace Admin;

use AppBundle\Entity\Image;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

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

        $productFieldOptions= ['property' => 'name'];

        $formMapper
            ->add('product', ModelType::class, $productFieldOptions)
            ->add('isFace', CheckboxType::class, ['required' => false])
            ->add('file', FileType::class, $fileFieldOptions)
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $dataGridMapper) : void {
        $dataGridMapper
            ->add('product', 'doctrine_orm_model_autocomplete'  ,[], null, ['property'=>'title'] )
            ->add('isFace')
            ->add('fileName')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) : void {
        $listMapper->addIdentifier('name');
        $listMapper->addIdentifier('product', null, ['associated_property' => 'name']);
        $listMapper->addIdentifier('isFace');
    }

    /** @param Image $image */
    public function prePersist($image) {
        $this->manageFileUpload($image);
    }

    /** @param Image $image */
    public function preUpdate($image) {
        $this->manageFileUpload($image);
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