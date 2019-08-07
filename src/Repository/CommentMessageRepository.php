<?php

namespace App\Repository;

use App\Entity\CommentMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CommentMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentMessage[]    findAll()
 * @method CommentMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentMessageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CommentMessage::class);
    }

    // /**
    //  * @return CommentMessage[] Returns an array of CommentMessage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommentMessage
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
