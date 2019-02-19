<?php

namespace App\Repository;

use App\Entity\Creature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Creature|null find($id, $lockMode = null, $lockVersion = null)
 * @method Creature|null findOneBy(array $criteria, array $orderBy = null)
 * @method Creature[]    findAll()
 * @method Creature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreatureRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Creature::class);
    }
}
