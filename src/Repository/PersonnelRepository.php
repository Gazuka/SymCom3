<?php

namespace App\Repository;

use App\Entity\Personnel;
use App\Entity\PersonnelFonction;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Personnel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personnel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personnel[]    findAll()
 * @method Personnel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Personnel::class);
    }

    // /**
    //  * @return Personnel[] Returns an array of Personnel objects
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
    public function findOneBySomeField($value): ?Personnel
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /*
    return $this->getEntityManager()
        ->createQueryBuilder()
        ->select('u, r')
        ->from('CRMCoreBundle:User', 'u')
        ->innerJoin('u.profiles','p')
        ->innerJoin('p.routegroups','rg')
        ->innerJoin('rg.routes','r')
        ->where('u.id = :user_id')->setParameter('user_id', $user->getId())
        ->getQuery()
        ->getResult();
        
        SELECT e, f
FROM sigaFactureBundle:ElementFacture e
JOIN e.Facture f

*/

    public function findByElus($value)
    {
        return $this->createQueryBuilder('p')
            ->leftjoin('p.fonctions', 'f')
            ->andWhere('f.structure = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
}
