<?php

namespace App\Repository;

use App\Entity\UserBase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserBase|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserBase|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserBase[]    findAll()
 * @method UserBase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserBaseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserBase::class);
    }

    // /**
    //  * @return UserBase[] Returns an array of UserBase objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserBase
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
