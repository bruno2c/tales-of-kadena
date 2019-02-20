<?php

namespace App\Core\Stage;

use App\Entity\BattleChampion;
use App\Entity\BattleEnemy;
use App\Entity\Creature;
use App\Repository\CreatureRepository;

class PrepareStage
{
    /** @var CreatureRepository */
    private $creatureRepository;

    public function __construct(CreatureRepository $creatureRepository)
    {
        $this->creatureRepository = $creatureRepository;
    }

    /**
     * @return \App\Entity\Creature[]|array
     */
    public function getRandomEnemies()
    {
        $qty = rand(1, 3);

        $monsters = $this->creatureRepository->findBy(['type' => Creature::TYPE_MONSTER]);
        shuffle($monsters);
        $monsters = array_slice($monsters, 0, $qty);

        return $monsters;
    }

    /**
     * @return \App\Entity\Creature[]|array
     */
    public function getRandomChampions()
    {
        $qty = rand(1, 3);

        $champions = $this->creatureRepository->findBy(['type' => Creature::TYPE_CHAMPION]);
        shuffle($champions);
        $champions = array_slice($champions, 0, $qty);

        return $champions;
    }

    public function prepareResponse($battleCreatures = [])
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