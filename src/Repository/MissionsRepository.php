<?php

namespace App\Repository;

use App\Entity\Missions;
use App\Entity\Status;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Missions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Missions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Missions[]    findAll()
 * @method Missions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * 
 * @method getMissionWithStatus()
 */
class MissionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Missions::class);
    }

    // /**
    //  * @return Missions[] Returns an array of Missions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Missions
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getMissionWithStatus()
    {
        $queryBuilder = $this->createQueryBuilder('m')
            ->select('m,s')
            ->leftJoin('m.status','s')
            ->getQuery()
            ->getResult();
    }
}
