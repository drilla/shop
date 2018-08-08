<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @author drilla
 *
 * Маршуты храним тут же, для наглядности
 */
class DefaultController extends Controller
{
    /** @var EntityManagerInterface  */
    private $_entityManager;

    public function __construct(EntityManagerInterface $manager) {
        $this->_entityManager = $manager;
    }

    /**
     * @Route("/", name="homepage")
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

        return $this->render('default/index.html.twig', [
            'productsJoint'     => $productsJoint,
            'productsWrinkles'  => $productsWrinkles,
            'specialOffers'     => $specialOffers,
            'specialOfferPairs' => $specialOfferPairs,
            'mainProduct'       => $mainProduct,
        ]);
    }

    /**
     * @Route("/product/{id}", name="product", requirements={"id"="\d+"})
     */
    public function productAction(int $id) {
        $product = $this->_getEntityManager()->getRepository(Product::class)->find($id);

        if (!$product) throw new NotFoundHttpException();

        return $this->render('default/product.html.twig', [
            'product' => $product
        ]);
    }

    private function _getEntityManager() : EntityManagerInterface {
        return $this->_entityManager;
    }
}
