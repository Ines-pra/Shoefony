<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Mailer\ContactMailer;
use App\Service\MessageGenerator;

class MainController extends AbstractController 
{
    private ContactMailer $mailer;

    public function __construct(ContactMailer $mailer)
    {
        $this->mailer = $mailer;
    }   

    /** 
     * @Route("/",name="main_homepage",methods={"GET"})
     */

    public function main() : Response
    {
        return $this->render('main/index.html.twig',[
            'title' => "Homepage",
        ]);
    }

    /** 
     * @Route("/presentation",name="main_presentation",methods={"GET"})
     */

    public function presentation() : Response
    {
        return $this->render('main/presentation.html.twig',[
            'title' => "Presentation",
        ]);
    }

     /** 
     * @Route("/contact",name="main_contact",methods={"GET","POST"})
     */

    public function contact(Request $request) : Response
    {

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            if ($form->isSubmitted() && $form->isValid()) {
                $this->addFlash('success', 'Merci, votre message a bien été pris en compte !');
                $this->mailer->sendMail($contact);
            return $this->redirectToRoute('main_contact');
        }

        return $this->render('main/contact.html.twig',[
            'title' => "Contact",
            'form' => $form->createView()
        ]);
    }
}
}