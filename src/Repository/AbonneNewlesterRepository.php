<?php

namespace App\Repository;

use App\Entity\AbonneNewlester;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AbonneNewlester|null find($id, $lockMode = null, $lockVersion = null)
 * @method AbonneNewlester|null findOneBy(array $criteria, array $orderBy = null)
 * @method AbonneNewlester[]    findAll()
 * @method AbonneNewlester[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AbonneNewlesterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AbonneNewlester::class);
    }

    // /**
    //  * @return AbonneNewlester[] Returns an array of AbonneNewlester objects
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
    public function findOneBySomeField($value): ?AbonneNewlester
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
