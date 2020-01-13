<?php


namespace App\Controller;

use App\Entity\GaleriePhotos;
use App\Repository\ArticleRepository;
use App\Repository\GaleriePhotosRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Source;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class GalerieController extends AbstractController
{
    /**
     * @Route("/galerie", name="galerie")
     */
    public function galerie()
    {
        return $this->render('galerie.html.twig');
    }

    /**
     * @Route("/GaleriePhotos", name="galeriePhotos")
     */
    public function photos()
    {
        return $this->render('galeriePhotos.html.twig');

    }


//j'ajoute de nouvelles photos,
//je supprime des photos




}