<?php

namespace App\Repository;

use App\Entity\MenuLien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MenuLien|null find($id, $lockMode = null, $lockVersion = null)
 * @method MenuLien|null findOneBy(array $criteria, array $orderBy = null)
 * @method MenuLien[]    findAll()
 * @method MenuLien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuLienRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MenuLien::class);
    }

    // /**
    //  * @return MenuLien[] Returns an array of MenuLien objects
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
    public function findOneBySomeField($value): ?MenuLien
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
