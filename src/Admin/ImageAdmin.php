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

/**
 *  * @author drilla
 */
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

            $serviceContainer =  $this->getConfigurationPool()->getContainer();

            $fullPath =  $serviceContainer->get('router')->generate('product_image', [
                'product_id' => $image->getProduct()->getId(),
                'file_name' => $image->getFileName(),
            ]);

            $imagineCacheManager = $serviceContainer->get('liip_imagine.cache.manager');
            $resolvedPath = $imagineCacheManager->getBrowserPath($fullPath, 'thumb_400');

            /*
             * чтобы избежать изменения шаблона админки, добавляем кастомную разметку с превью
             */
            $fileFieldOptions['help'] = $this->_getImageMarkup($resolvedPath);
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
            ->add('product', 'doctrine_orm_model_autocomplete'  , [], null, ['property'=>'name'] )
            ->add('isFace')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) : void {
        $listMapper->addIdentifier('id');
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


    /**
     * разметка с картинкой
     */
    private function _getImageMarkup(string $imagePath) : string {
        return '<img width="200" height="200" src="' . $imagePath . '" class="admin-preview" />';

        /*
         * как вариант, можно рендерить картинку через шаблон, а не разметкой в коде
         */
        //            $imageHtml = $this->getConfigurationPool()->getContainer()->get('templating')->render(
        //                'common/_image.html.twig', [
        //                    'width' => 200,
        //                    'height' => 200,
        //                    'class' => 'admin-preview',
        //                    'filter' => 'thumb_400',
        //                    'fullPath' => $fullPath,
        //                ]
        //            );
    }
}