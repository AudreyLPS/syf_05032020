<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Form\Model\ContactFormModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController 
{

    /**
        * @Route("/contact", name="contact.form")
    */
    
    public function form(Request $request, EntityManagerInterface $entityManager):Response {
		$type  = ContactType::class;
		$model = new Contact();
		$form  = $this->createForm($type,$model);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			
			$entityManager->persist($model);
			$entityManager->flush();
			
			return $this->redirectToRoute('homepage.index');

		}

        return $this->render("contact/form.html.twig",[
			'form'=>$form->createView()			
        ]);
}
}