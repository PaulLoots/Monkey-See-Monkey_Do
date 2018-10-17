<?php

namespace App\Repository;

use App\Entity\MonkeySeeMonkeyDo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MonkeySeeMonkeyDo|null find($id, $lockMode = null, $lockVersion = null)
 * @method MonkeySeeMonkeyDo|null findOneBy(array $criteria, array $orderBy = null)
 * @method MonkeySeeMonkeyDo[]    findAll()
 * @method MonkeySeeMonkeyDo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonkeySeeMonkeyDoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MonkeySeeMonkeyDo::class);
    }

//    /**
//     * @return MonkeySeeMonkeyDo[] Returns an array of MonkeySeeMonkeyDo objects
//     */
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
    public function findOneBySomeField($value): ?MonkeySeeMonkeyDo
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
