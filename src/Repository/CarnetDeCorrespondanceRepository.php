<?php

namespace App\Repository;

use App\Entity\CarnetDeCorrespondance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CarnetDeCorrespondance|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarnetDeCorrespondance|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarnetDeCorrespondance[]    findAll()
 * @method CarnetDeCorrespondance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarnetDeCorrespondanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarnetDeCorrespondance::class);
    }

    // /**
    //  * @return CarnetDeCorrespondance[] Returns an array of CarnetDeCorrespondance objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CarnetDeCorrespondance
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
