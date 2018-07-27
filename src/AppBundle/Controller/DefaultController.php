<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $manager = $this->container->get('doctrine.orm.entity_manager');

        $products = $manager->getRepository(Product::class)->findAll();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'products' => $products,
        ]);
    }
}
