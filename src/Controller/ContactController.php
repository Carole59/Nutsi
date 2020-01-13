<?php


namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ContactController extends AbstractController
{

    /**
     * @Route("/contact", name="contact_create")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function create(Request $request,EntityManagerInterface $entityManager)
    {
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


        return $this->render('contact.html.twig', [
            'contactFormView' => $contactFormView
        ]);

    }

}
