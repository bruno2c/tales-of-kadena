<?php

namespace App\Repository;

use App\Entity\Battle;
use App\Entity\BattleTurn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BattleTurn|null find($id, $lockMode = null, $lockVersion = null)
 * @method BattleTurn|null findOneBy(array $criteria, array $orderBy = null)
 * @method BattleTurn[]    findAll()
 * @method BattleTurn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BattleTurnRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BattleTurn::class);
    }

    public function getOpenTurn(Battle $battle)
    {
        return $this->findOneBy(['battle' => $battle, 'closed' => false]);
    }
}
