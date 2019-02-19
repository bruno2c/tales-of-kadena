<?php

namespace App\Repository;

use App\Entity\BattleChampion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BattleChampion|null find($id, $lockMode = null, $lockVersion = null)
 * @method BattleChampion|null findOneBy(array $criteria, array $orderBy = null)
 * @method BattleChampion[]    findAll()
 * @method BattleChampion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BattleChampionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BattleChampion::class);
    }

    // /**
    //  * @return BattleEnemy[] Returns an array of BattleEnemy objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BattleEnemy
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
