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
        $monsters = $this->creatureRepository->findBy(['type' => Creature::TYPE_MONSTER]);
        shuffle($monsters);
        $monsters = array_slice($monsters, 0, 3);

        return $monsters;
    }

    /**
     * @return \App\Entity\Creature[]|array
     */
    public function getRandomChampions()
    {
        $champions = $this->creatureRepository->findBy(['type' => Creature::TYPE_CHAMPION]);
        shuffle($champions);
        $champions = array_slice($champions, 0, 3);

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

            $enemies[] = [
                'id' => $battleCreature->getId(),
                'slot' =>  $i + 1,
                'health' => $battleCreature->getHealth(),
                'sprite' => $creature->getSpriteName(),
                'attack' => $battleCreature->getAttack(),
                'defense' => $battleCreature->getDefense()
            ];
        }

        return $enemies;
    }
}