<?php

namespace App\Repository;

use App\Entity\ObjetCarnet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ObjetCarnet|null find($id, $lockMode = null, $lockVersion = null)
 * @method ObjetCarnet|null findOneBy(array $criteria, array $orderBy = null)
 * @method ObjetCarnet[]    findAll()
 * @method ObjetCarnet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjetCarnetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ObjetCarnet::class);
    }

    // /**
    //  * @return ObjetCarnet[] Returns an array of ObjetCarnet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ObjetCarnet
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
