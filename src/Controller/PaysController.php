<?php

namespace App\Controller;

use App\Repository\EtapeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PaysController extends AbstractController 
{  
    /**
     * @Route("/pays/{id}", name="pays.index")
     */
    
    public function index( EtapeRepository $etapeRepository, int $id):Response {
        
		$results=$etapeRepository->findBy(array('pays'=>$id));

		return $this->render('pays/index.html.twig', [
			'results' => $results
		]);
    }



	
}