<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class PrestationController extends AbstractController
{
    /**
     * @Route("/prestation", name="prestation")
     */

    public function prestation()
    {
        return $this->render('prestation.html.twig');
    }
}