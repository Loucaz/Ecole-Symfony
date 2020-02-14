<?php

namespace App\Repository;

use App\Entity\PhotoDeClasse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PhotoDeClasse|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotoDeClasse|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotoDeClasse[]    findAll()
 * @method PhotoDeClasse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoDeClasseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhotoDeClasse::class);
    }

    // /**
    //  * @return PhotoDeClasse[] Returns an array of PhotoDeClasse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PhotoDeClasse
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
