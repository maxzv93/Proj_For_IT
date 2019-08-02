<?php

namespace App\Repository;

use App\Entity\Devicce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Devicce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Devicce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Devicce[]    findAll()
 * @method Devicce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DevicceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Devicce::class);
    }

    // /**
    //  * @return Devicce[] Returns an array of Devicce objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Devicce
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
