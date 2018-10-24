<?php

namespace App\Repository;

use App\Entity\RiddleLikes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RiddleLikes|null find($id, $lockMode = null, $lockVersion = null)
 * @method RiddleLikes|null findOneBy(array $criteria, array $orderBy = null)
 * @method RiddleLikes[]    findAll()
 * @method RiddleLikes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RiddleLikesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RiddleLikes::class);
    }

//    /**
//     * @return RiddleLikes[] Returns an array of RiddleLikes objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RiddleLikes
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
