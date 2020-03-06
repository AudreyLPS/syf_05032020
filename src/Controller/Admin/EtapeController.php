<?php

namespace App\Controller\Admin;

use App\Entity\Etape;
use App\Form\EtapeType;
use App\Repository\EtapeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */
class EtapeController extends AbstractController
{
	/**
	 * @Route("/etape", name="admin.etape.index")
	 */
	public function index(EtapeRepository $etapeRepository):Response
	{
		$results = $etapeRepository->findAll();

		return $this->render('admin/etape/index.html.twig', [
			'results' => $results
		]);
	}


	/**
	 * @Route("/etapes/delete/{id}", name="admin.etape.delete")
	 */
	public function delete( EtapeRepository $etapeRepository, EntityManagerInterface $entityManager, int $id):Response
	{
		$entity= $etapeRepository->find($id);
		$entityManager->remove($entity);
		$entityManager->flush();
		$this->addFlash('notice_danger', "L'étape à été supprimée");
		return $this->redirectToRoute('admin.etape.index');
        
	}


	/**
     * @Route("/etapes/form", name="admin.etape.form")
     * @Route("/etapes/form/update/{id}", name="admin.etape.form.update")
     */

    public function form(Request $request, EntityManagerInterface $entityManager, int $id = null, EtapeRepository $etapeRepository):Response{
		
		$type  = EtapeType::class;
		$model = $id ? $etapeRepository->find($id) : new Etape();
		$form  = $this->createForm($type,$model);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			
			$id ? null : $entityManager->persist($model);
			$entityManager->flush();

			 $id ? $message="L'etape à été modifié" : $message="L'étape a été ajoutée" ;
			 $this->addFlash('notice', $message);
            
			 return $this->redirectToRoute('admin.etape.index');

		}

        return $this->render("admin/etape/form.html.twig",[
			'form'=>$form->createView()			
        ]);
    }

}








