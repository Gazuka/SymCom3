<?php

namespace App\Repository;

use App\Entity\ArticleContentImg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ArticleContentImg|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleContentImg|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleContentImg[]    findAll()
 * @method ArticleContentImg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleContentImgRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ArticleContentImg::class);
    }

    // /**
    //  * @return ArticleContentImg[] Returns an array of ArticleContentImg objects
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
    public function findOneBySomeField($value): ?ArticleContentImg
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
