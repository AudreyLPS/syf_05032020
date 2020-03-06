<?php

namespace App\Repository;

use App\Entity\Etape;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Etape|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etape|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etape[]    findAll()
 * @method Etape[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtapeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etape::class);
    }

     /**
     * @return Etape[] Returns an array of Etape objects
    */
    
    public function nbEtape()
    {
        return $this->createQueryBuilder('etape')
        
            ->select    ('COUNT(etape.id) AS NombreDetape, pays.name AS paysName,continent.name AS continentName, pays.id as paysId')
            ->join('etape.pays', 'pays')
            ->join('pays.continent', 'continent')
            ->groupBy('pays.name','continent.name')
            ->getQuery()
            ->getResult();
    }
}
