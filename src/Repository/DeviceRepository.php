<?php

namespace App\Repository;

use App\Entity\Device;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Device|null find($id, $lockMode = null, $lockVersion = null)
 * @method Device|null findOneBy(array $criteria, array $orderBy = null)
 * @method Device[]    findAll()
 * @method Device[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeviceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Device::class);
    }


    public function findAllEqualToPhone($data): array
    {
        if($data['Phone']=="")
            $Phone="";
        else
            $Phone = $data['Phone'];

        if($data['MinPrice']=="")
            $MinPrice = 0;
        else
            $MinPrice = $data['MinPrice'];
        if($data['MaxPrice']=="")
            $MaxPrice = 1000000000;
        else
            $MaxPrice = $data['MaxPrice'];

        if($data['MinVol']=="")
            $MinVol = 0;
        else
            $MinVol = $data['MinVol'];
        if($data['MaxVol']=="")
            $MaxVol = 1000000000;
        else
            $MaxVol = $data['MaxVol'];




        $entityManager = $this->getEntityManager();





        if($data['Phone']=="")
        {
            $query = $entityManager->createQuery(
                'SELECT p
                FROM App\Entity\Device p
                WHERE p.Price >= :MinPrice
                AND p.Price <= :MaxPrice
                AND p.MemorySize >= :MinVol
                AND p.MemorySize <= :MaxVol'
            )->setParameters([ 'MinPrice' => $MinPrice, 'MaxPrice' => $MaxPrice,
                'MaxVol' => $MaxVol, 'MinVol' => $MinVol]);
        }
        else
        {
            $query = $entityManager->createQuery(
                'SELECT p
                FROM App\Entity\Device p
                WHERE p.Phone = :Phone
                AND p.Price >= :MinPrice
                AND p.Price <= :MaxPrice
                AND p.MemorySize >= :MinVol
                AND p.MemorySize <= :MaxVol'
            )->setParameters(['Phone' => $Phone, 'MinPrice' => $MinPrice, 'MaxPrice' => $MaxPrice,
                'MaxVol' => $MaxVol, 'MinVol' => $MinVol]);
        }



        // returns an array of Product objects
        return $query->execute();
    }









    // /**
    //  * @return Device[] Returns an array of Device objects
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
    public function findOneBySomeField($value): ?Device
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
