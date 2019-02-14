<?php

namespace App\Repository;

use App\Entity\TupeCours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TupeCours|null find($id, $lockMode = null, $lockVersion = null)
 * @method TupeCours|null findOneBy(array $criteria, array $orderBy = null)
 * @method TupeCours[]    findAll()
 * @method TupeCours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TupeCoursRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TupeCours::class);
    }

    // /**
    //  * @return TupeCours[] Returns an array of TupeCours objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TupeCours
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
