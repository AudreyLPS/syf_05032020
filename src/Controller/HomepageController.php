<?php

namespace App\Controller;

use App\Repository\ContinentRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage.index")
     */
    public function index(ContinentRepository $continentRepository)
    {
        $results = $continentRepository->findAll();
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'results'=>$results,
        ]);
    }
}
