<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;


/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    private $em;

    public function __construct(ManagerRegistry $registry,EntityManagerInterface $em)
    {
        parent::__construct($registry, Article::class);
        $this->em = $em;
    }


    /**
     * @param $id
     * @return Article|null
     * @throws \Exception
     */
    public function findOneBySomeField($id): ?Article
    {
        try {
            return $this->createQueryBuilder('a')
                ->select('a','tags','cat')
                ->leftJoin('a.tags','tags')
                ->join('a.category','cat')
                ->where('a.id = :id')
                ->andWhere('tags.id <> 0')
                ->setParameter('id', $id)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            throw new \Exception('No items');
        }
    }


    public function findAllArticles()
    {
        try{
            $query = $this->createQueryBuilder('a')
                ->select('a','tags','cat')
                ->leftJoin('a.tags','tags')
                ->join('a.category','cat')
                ->where('SIZE (a.tags) = 0')
                ->orWhere('tags.id <> 0')
                ->orderBy('a.dateEdit','DESC')
                ->getQuery();
        } catch (\Exception $e){
            return new \Exception($e->getMessage());
        }
        return $query->getArrayResult();
    }

    /**
     * @param $handled
     * @return Article
     * @throws \Exception
     */
    public function addNewArticle($handled): Article
    {
        try {
            $entityManager = $this->em;
            $entityManager->persist($handled);
            $entityManager->flush();
            return $handled;
        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

}
