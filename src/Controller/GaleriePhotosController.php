<?php

namespace App\Controller;

use App\Entity\GaleriePhotos;
use App\Form\GaleriePhotosType;
use App\Repository\GaleriePhotosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/galerie/photos")
 */
class GaleriePhotosController extends AbstractController
{
    /**
     * @Route("/", name="galerie_photos_index", methods={"GET"})
     * @param GaleriePhotosRepository $galeriePhotosRepository
     * @return Response
     */
    public function index(GaleriePhotosRepository $galeriePhotosRepository): Response
    {
        return $this->render('galerie_photos/index.html.twig', [
            'galerie_photos' => $galeriePhotosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="galerie_photos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $galeriePhoto = new GaleriePhotos();
        $form = $this->createForm(GaleriePhotosType::class, $galeriePhoto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($galeriePhoto);
            $entityManager->flush();

            return $this->redirectToRoute('galerie_photos_index');
        }

        return $this->render('galerie_photos/new.html.twig', [
            'galerie_photo' => $galeriePhoto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="galerie_photos_show", methods={"GET"})
     * @param GaleriePhotos $galeriePhoto
     * @return Response
     */
    public function show(GaleriePhotos $galeriePhoto): Response
    {
        return $this->render('galerie_photos/show.html.twig', [
            'galerie_photo' => $galeriePhoto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="galerie_photos_edit", methods={"GET","POST"})
     * @param Request $request
     * @param GaleriePhotos $galeriePhoto
     * @return Response
     */
    public function edit(Request $request, GaleriePhotos $galeriePhoto): Response
    {
        $form = $this->createForm(GaleriePhotosType::class, $galeriePhoto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('galerie_photos_index');
        }

        return $this->render('galerie_photos/edit.html.twig', [
            'galerie_photo' => $galeriePhoto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="galerie_photos_delete", methods={"DELETE"})
     * @param Request $request
     * @param GaleriePhotos $galeriePhoto
     * @return Response
     */
    public function delete(Request $request, GaleriePhotos $galeriePhoto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$galeriePhoto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($galeriePhoto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('galerie_photos_index');
    }
}
