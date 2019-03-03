<?php

namespace App\Core\Battle;

use App\Entity\Battle;
use App\Entity\BattleChampion;
use App\Entity\BattleEnemy;
use Doctrine\ORM\EntityManager;

class BattleResponse
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function prepareResponse(Battle $battle)
    {
        $champions = $this->em->getRepository(BattleChampion::class)->findBy(['battle' => $battle]);
        $enemies = $this->em->getRepository(BattleEnemy::class)->findBy(['battle' => $battle]);

        return [
            'hash' => $battle->getHash(),
            'qtyEnemies' => count($enemies),
            'enemies' => $this->prepareCreaturesResponse($enemies),
            'qtyChampions' => count($champions),
            'champions' => $this->prepareCreaturesResponse($champions),
        ];
    }

    private function prepareCreaturesResponse($battleCreatures = [])
    {
        $enemies = [];

        foreach ($battleCreatures as $i => $battleCreature) {
            $creature = null;

            if ($battleCreature instanceof  BattleEnemy) {
                $creature = $battleCreature->getMonster();
            }

            if ($battleCreature instanceof  BattleChampion) {
                $creature = $battleCreature->getChampion();
            }

            $healthPercentage = round(($battleCreature->getHealth() / $battleCreature->getMaxHealth()) * 100);

            $enemies[] = [
                'id' => $battleCreature->getId(),
                'name' => $creature->getName(),
                'slot' =>  $i + 1,
                'maxHealth' => $battleCreature->getMaxHealth(),
                'health' => $battleCreature->getHealth(),
                'healthPercentage' => $healthPercentage,
                'sprite' => $creature->getSpriteName(),
                'attack' => $battleCreature->getAttack(),
                'defense' => $battleCreature->getDefense()
            ];
        }

        return $enemies;
    }
}