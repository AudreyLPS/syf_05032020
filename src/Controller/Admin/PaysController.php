<?php

namespace App\Controller\Admin;

use App\Repository\PaysRepository;
use App\Repository\EtapeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
     *///string $pays
    public function index(Request $request, PaysRepository $paysRepository, EtapeRepository $etapeRepository):Response
    {
        $results = $etapeRepository->nbEtape();
		return $this->render('admin/pays/index.html.twig', [
            'results' => $results,
            
		]);
    }

    /** 
	 * @Route("/pays/delete/{id}", name="admin.pays.delete")
	 */
	public function delete( EtapeRepository $etapeRepository, PaysRepository $paysRepository, EntityManagerInterface $entityManager, int $id):Response
	{
        $etapes=$etapeRepository->findBy(array('pays'=>$id));
        foreach ( $etapes as $unEtape) {
            $entityManager->remove($unEtape);
        }
		$entity= $paysRepository->find($id);
		$entityManager->remove($entity);
		$entityManager->flush();
		$this->addFlash('notice_danger', "Le pays a été supprimé avec l'ensemble de ses étapes");
		return $this->redirectToRoute('admin.pays');
        
	}
    
}
