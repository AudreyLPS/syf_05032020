<?php

namespace App\Controller\Admin;

use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */
class ContactController extends AbstractController 
{  
    /**
     * @Route("/contact", name="admin.contact.index")
     */
    
    public function index( ContactRepository $contactRepository):Response {
      $results = $contactRepository ->findAll();
      return $this->render('admin/contact/index.html.twig', [
        'results' => $results
      ]);
    }
   
    /**
     * @Route("/contact/delete/{id}", name="admin.contact.delete")
     */
    public function delete( ContactRepository $contactRepository, EntityManagerInterface $entityManager, int $id):Response
    {
      $entity= $contactRepository->find($id);
      $entityManager->remove($entity);
      $entityManager->flush();
      $this->addFlash('notice_danger', "Le message à été supprimé");
      return $this->redirectToRoute('admin.contact.index');
          
    }


}