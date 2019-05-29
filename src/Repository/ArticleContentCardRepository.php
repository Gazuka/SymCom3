<?php

namespace App\Repository;

use App\Entity\ArticleContentCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ArticleContentCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleContentCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleContentCard[]    findAll()
 * @method ArticleContentCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleContentCardRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ArticleContentCard::class);
    }

    // /**
    //  * @return ArticleContentCard[] Returns an array of ArticleContentCard objects
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
    public function findOneBySomeField($value): ?ArticleContentCard
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
