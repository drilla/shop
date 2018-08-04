<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author drilla
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, EntityManagerInterface $manager)
    {
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

        return $this->render('default/index.html.twig', [
            'productsJoint'    => $productsJoint,
            'productsWrinkles' => $productsWrinkles,
            'specialOffers'    => $specialOffers,
            'specialOfferPairs'    => $specialOfferPairs,
            'mainProduct'      => $mainProduct,
        ]);
    }
}
