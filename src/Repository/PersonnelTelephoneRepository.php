<?php

namespace App\Repository;

use App\Entity\PersonnelTelephone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PersonnelTelephone|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonnelTelephone|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonnelTelephone[]    findAll()
 * @method PersonnelTelephone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnelTelephoneRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PersonnelTelephone::class);
    }

    // /**
    //  * @return PersonnelTelephone[] Returns an array of PersonnelTelephone objects
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
    public function findOneBySomeField($value): ?PersonnelTelephone
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
