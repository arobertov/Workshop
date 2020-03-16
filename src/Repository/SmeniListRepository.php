<?php

namespace App\Repository;

use App\Entity\SmeniList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SmeniList|null find($id, $lockMode = null, $lockVersion = null)
 * @method SmeniList|null findOneBy(array $criteria, array $orderBy = null)
 * @method SmeniList[]    findAll()
 * @method SmeniList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SmeniListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SmeniList::class);
    }

    // /**
    //  * @return SmeniList[] Returns an array of SmeniList objects
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
    public function findOneBySomeField($value): ?SmeniList
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
