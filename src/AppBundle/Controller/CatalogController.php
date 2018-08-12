<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Order;
use AppBundle\Entity\Product;
use AppBundle\Form\OrderType;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
    public function indexAction() {
        $manager = $this->_getEntityManager();

        /** @var EntityRepository $productRepo */
        $productRepo = $manager->getRepository(Product::class);
        $products    = $productRepo->findAll();

        $specialOffers = $productRepo->createQueryBuilder('p')->where('p.fakePrice is not null')->getQuery()->getResult();

        $productsWrinkles = $manager->getRepository(Product::class)->findBy(
            ['category' => Product::CAT_WRINKLES]
        );

        $mainProduct = $specialOffers[0];

        $specialOfferPairs = [];
        $pair              = [];

        foreach ($specialOffers as $specialOffer) {
            if (count($pair) === 2) {
                $specialOfferPairs[] = $pair;
                $pair                = [];
            }

            $pair[] = $specialOffer;
        }

        //добавим неполную пару
        if (count($pair)) {
            $specialOfferPairs[] = $pair;
        }

        $orderForm = $this->createForm(OrderType::class, new Order(),
            [
                'action' => $this->generateUrl('create_order'),
                'method' => 'POST',
            ]);

        return $this->render('catalog/index.html.twig', [
            'products'          => $products,
            'productsWrinkles'  => $productsWrinkles,
            'specialOffers'     => $specialOffers,
            'specialOfferPairs' => $specialOfferPairs,
            'mainProduct'       => $mainProduct,
            'orderForm'         => $orderForm->createView(),
        ]);
    }
}
