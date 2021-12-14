<?php

namespace App\Repository;

use App\Entity\Stashs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stashs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stashs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stashs[]    findAll()
 * @method Stashs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StashsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stashs::class);
    }

    // /**
    //  * @return Stashs[] Returns an array of Stashs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stashs
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
