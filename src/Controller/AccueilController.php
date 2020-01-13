<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function accueil(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $entityManager){

        $contact = new Contact();

        $contactForm = $this->createForm(ContactType::class, $contact);
        $contactFormView = $contactForm->createView();

        if ($request->isMethod('Post')) {

            $contactForm->handleRequest($request);

            if ($contactForm->isValid()) {

                $entityManager->persist($contact);
                $entityManager->flush();
            }
        }
        return $this->render('accueil.html.twig',  [
'contactFormView' => $contactFormView
]);
    }
}