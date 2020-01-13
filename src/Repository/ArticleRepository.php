<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getByNom(){
//-Récupère le query builder (car c'est le query builder
//qui permet de faire la requête SQL
        $queryBuilder = $this->createQueryBuilder('a');


    //-Construire la requête façon SQL, mais en php
//-Traduire la requête en véritable requête SQL
    $queryBuilder = $this->createQueryBuilder('nom');
$query = $queryBuilder->select('nom')
            ->where ('id.article LIKE :word')
//"setParameter est une sécurité qui ne pourra pas être modifiée par un utlisisateur
            ->setParameter('word','%' . 'nom' . '%')
            ->getQuery();

//-Exécute la requête SQL en BDD pour récupérer les articles
            return $query ->getResult();

}

    public function getByName()
    {
    }
}
