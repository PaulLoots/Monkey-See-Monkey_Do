<?php

namespace App\Repository;

use App\Entity\Riddle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Riddle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Riddle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Riddle[]    findAll()
 * @method Riddle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RiddleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Riddle::class);
    }

//    /**
//     * @return Riddle[] Returns an array of Riddle objects
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
    public function findOneBySomeField($value): ?Riddle
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
