<?php

namespace App\Controller\Admin;

use App\Repository\PaysRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */
class PaysController extends AbstractController
{
    /**
     * @Route("/pays", name="admin.pays")
     */
    public function index(PaysRepository $paysRepository):Response
    {
        $results = $paysRepository->findAll();

		return $this->render('admin/pays/index.html.twig', [
			'results' => $results
		]);
    }
}
