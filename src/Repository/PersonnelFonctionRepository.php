<?php

namespace App\Repository;

use App\Entity\PersonnelFonction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PersonnelFonction|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonnelFonction|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonnelFonction[]    findAll()
 * @method PersonnelFonction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnelFonctionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PersonnelFonction::class);
    }

    // /**
    //  * @return PersonnelFonction[] Returns an array of PersonnelFonction objects
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
    public function findOneBySomeField($value): ?PersonnelFonction
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
