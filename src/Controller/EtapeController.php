<?php

namespace App\Controller;

use App\Repository\EtapeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtapeController extends AbstractController 
{  
    /**
     * @Route("/etapes", name="etape.index")
     */
    
    public function index( EtapeRepository $etapeRepository):Response {
        
		$results = $etapeRepository->findAll();

		return $this->render('etape/index.html.twig', [
			'results' => $results
		]);
    }

	/**
	 * @Route("/etape/{id}", name="etape.details")
	 */

	public function details(int $id, EtapeRepository $etapeRepository):Response
	{
		
		$etape = $etapeRepository->find($id);

		return $this->render('etape/details.html.twig', [
			'etape' => $etape
		]);
	}

	
}