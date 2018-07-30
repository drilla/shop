<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, EntityManagerInterface $manager)
    {

        $products = $manager->getRepository(Product::class)->findAll();

        // replace this example code with whatever you need

        $productsJoint = $manager->getRepository(Product::class)->findBy(
            ['category' => Product::CAT_JOINT]
        );

        $productsWrinkles = $manager->getRepository(Product::class)->findBy(
            ['category' => Product::CAT_WRINKLES]
        );

        return $this->render('default/index.html.twig', [
            'productsJoint'    => $productsJoint,
            'productsWrinkles' => $productsWrinkles,
        ]);
    }
}
