<?php

namespace App\Repository;

use App\Entity\SpiritualPearls;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SpiritualPearls|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpiritualPearls|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpiritualPearls[]    findAll()
 * @method SpiritualPearls[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpiritualPearlsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpiritualPearls::class);
    }

    // /**
    //  * @return SpiritualPearls[] Returns an array of SpiritualPearls objects
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
    public function findOneBySomeField($value): ?SpiritualPearls
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
