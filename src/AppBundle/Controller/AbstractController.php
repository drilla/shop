<?php
/**
 * Created by PhpStorm.
 * User: vkuznetsov
 * Date: 08.08.18
 * Time: 17:26
 */

namespace AppBundle\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class AbstractController extends Controller
{
    /** @var EntityManagerInterface  */
    private $_entityManager;

    public function __construct(EntityManagerInterface $manager) {
        $this->_entityManager = $manager;
    }

    protected function _getEntityManager() : EntityManagerInterface {
        return $this->_entityManager;
    }

}