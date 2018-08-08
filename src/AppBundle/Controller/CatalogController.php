<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @author drilla
 *
 * Маршуты храним тут же, для наглядности
 */
class CatalogController extends AbstractController
{
    /**
     * @Route("/", name="catalog")
     */
    public function indexAction()
    {
        $manager = $this->_getEntityManager();
        $products = $manager->getRepository(Product::class)->findAll();

        $specialOffers = $products;
        // replace this example code with whatever you need

        $productsJoint = $manager->getRepository(Product::class)->findBy(
            ['category' => Product::CAT_JOINT]
        );

        $productsWrinkles = $manager->getRepository(Product::class)->findBy(
            ['category' => Product::CAT_WRINKLES]
        );

        $mainProduct = $specialOffers[0];

        $specialOfferPairs = [];
        $pair = [];
        foreach ($specialOffers as $specialOffer) {
            if (count($pair) === 2) {
                $specialOfferPairs[] = $pair;
                $pair = [];
            }

            $pair[] = $specialOffer;
        }

         //добавим неполную пару
        if (count($pair)) {
            $specialOfferPairs[] = $pair;
        }

        return $this->render('catalog/index.html.twig', [
            'productsJoint'     => $productsJoint,
            'productsWrinkles'  => $productsWrinkles,
            'specialOffers'     => $specialOffers,
            'specialOfferPairs' => $specialOfferPairs,
            'mainProduct'       => $mainProduct,
        ]);
    }
}
