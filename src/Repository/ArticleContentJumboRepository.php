<?php

namespace App\Repository;

use App\Entity\ArticleContentJumbo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ArticleContentJumbo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleContentJumbo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleContentJumbo[]    findAll()
 * @method ArticleContentJumbo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleContentJumboRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ArticleContentJumbo::class);
    }

    // /**
    //  * @return ArticleContentJumbo[] Returns an array of ArticleContentJumbo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArticleContentJumbo
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
