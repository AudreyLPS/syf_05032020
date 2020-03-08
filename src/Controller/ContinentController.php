<?php

namespace App\Controller;

use App\Repository\PaysRepository;
use App\Repository\ContinentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContinentController extends AbstractController 
{  
    /**
     * @Route("/continent/{id}", name="continent.index")
     */
    
    public function index( ContinentRepository $continentRepository, PaysRepository $paysRepository, int $id):Response {
        
    $continent=$continentRepository->find($id);
		$results=$paysRepository->findBy(array('continent'=>$id));

		return $this->render('continent/index.html.twig', [
      'results' => $results, 
      'continent'=>$continent
		]);
    }



	
}