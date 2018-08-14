<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Order;
use AppBundle\Form\OrderType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    const STATUS_OK = 1;
    const STATUS_FAIL = 0;

    /**
     * @Route("/order/create", name="create_order", requirements={})
     */
    public function createAction(Request $request) {
        if (!$request->isXmlHttpRequest()) throw new BadRequestHttpException('json request only allowed');

        $form = $this->createForm(OrderType::class);

        $form->handleRequest($request);

        if ( $form->isValid()) {
            /** @var Order $order */
            $order = $form->getData();
            $order->setIp($this->_getIp($request));
            $this->_getEntityManager()->persist($order);
            $this->_getEntityManager()->flush();
        } else {
            return $this->json(['status' => self::STATUS_FAIL]);
        }

        return $this->json(['status' => self::STATUS_OK]);
    }

    private function _getIp(Request $request) : ? string {
        $ip = $request->getClientIp();
        if($ip == 'unknown'){
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}