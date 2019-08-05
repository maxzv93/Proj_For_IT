<?php

namespace App\Repository;

use App\Entity\ServiceInformation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ServiceInformation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceInformation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceInformation[]    findAll()
 * @method ServiceInformation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceInformationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ServiceInformation::class);
    }

    // /**
    //  * @return ServiceInformation[] Returns an array of ServiceInformation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ServiceInformation
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
