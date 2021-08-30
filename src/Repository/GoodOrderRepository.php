<?php

namespace App\Repository;

use App\Entity\GoodOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GoodOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method GoodOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method GoodOrder[]    findAll()
 * @method GoodOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GoodOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GoodOrder::class);
    }

    // /**
    //  * @return GoodOrder[] Returns an array of GoodOrder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GoodOrder
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
