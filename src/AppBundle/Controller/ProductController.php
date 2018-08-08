<?php
/**
 * @author drilla
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{id}", name="product", requirements={"id"="\d+"})
     */
    public function indexAction(int $id) {
        $product = $this->_getEntityManager()->getRepository(Product::class)->find($id);

        if (!$product) throw new NotFoundHttpException();

        return $this->render('product/index.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("/product/{id}/review", name="review", requirements={"id"="\d+"})
     */
    public function reviewAction(int $id) {
        $product = $this->_getEntityManager()->getRepository(Product::class)->find($id);

        if (!$product) throw new NotFoundHttpException();

        return $this->render('product/review.html.twig', [
            'product' => $product
        ]);

    }


}