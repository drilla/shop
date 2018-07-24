<?php

namespace AppBundle\Form\Mapper;

use AppBundle\Entity\Product;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Exception;
use Symfony\Component\Form\FormInterface;

class ProductMapper implements DataMapperInterface
{

    /**
     * Maps properties of some data to a list of forms.
     *
     * @param Product $data Structured data
     * @param FormInterface[]|\Traversable $forms A list of {@link FormInterface} instances
     *
     * @throws Exception\UnexpectedTypeException if the type of the data parameter is not supported
     */
    public function mapDataToForms($data, $forms) {

        $forms = iterator_to_array($forms);

        if (!$data) {
            $forms['name']->setData('');
            $forms['price']->setData(null);
            $forms['description']->setData('');
        } else {
            $forms['name']->setData($data->getName());
            $forms['price']->setData($data->getPrice());
            $forms['description']->setData($data->getDescription());
        }
    }

    /**
     * Maps the data of a list of forms into the properties of some data.
     *
     * @param FormInterface[]|\Traversable $forms A list of {@link FormInterface} instances
     * @param mixed $data Structured data
     *
     * @throws Exception\UnexpectedTypeException if the type of the data parameter is not supported
     */
    public function mapFormsToData($forms, &$data) {
        $forms = iterator_to_array($forms);

        if (null === $data->getId()) {
            $name = $forms['name']->getData();
            $price = $forms['price']->getData();
            $description = $forms['description']->getData();

            // New entity is created
            $data = new Product(
                $name, $price, $description
            );

        } else {
            $data->update(
                $forms['name']->getData(),
                $forms['price']->getData(),
                $forms['description']->getData()
            );
        }
    }
}