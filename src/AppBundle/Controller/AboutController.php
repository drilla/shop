<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Общая информация о компании
 */
class AboutController extends Controller
{
    /**
     * @Route("/zdorov", name="about_us")
     */
    public function indexAction()
    {
        return $this->render('about/about.html.twig');
    }
}
