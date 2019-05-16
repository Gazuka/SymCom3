<?php

namespace App\Repository;

use App\Entity\PersonnelMail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PersonnelMail|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonnelMail|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonnelMail[]    findAll()
 * @method PersonnelMail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnelMailRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PersonnelMail::class);
    }

    // /**
    //  * @return PersonnelMail[] Returns an array of PersonnelMail objects
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
    public function findOneBySomeField($value): ?PersonnelMail
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
