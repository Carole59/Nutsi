<?php

namespace App\Repository;

use App\Entity\GaleriePhotos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GaleriePhotos|null find($id, $lockMode = null, $lockVersion = null)
 * @method GaleriePhotos|null findOneBy(array $criteria, array $orderBy = null)
 * @method GaleriePhotos[]    findAll()
 * @method GaleriePhotos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GaleriePhotosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GaleriePhotos::class);
    }

    // /**
    //  * @return GaleriePhotos[] Returns an array of GaleriePhotos objects
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
    public function findOneBySomeField($value): ?GaleriePhotos
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
