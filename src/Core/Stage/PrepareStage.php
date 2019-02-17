<?php

namespace App\Core\Stage;

use App\Repository\MonsterRepository;

class PrepareStage
{
    /** @var MonsterRepository */
    private $monsterRepo;

    public function __construct(MonsterRepository $monsterRepo)
    {
        $this->monsterRepo = $monsterRepo;
    }

    /**
     * @return \App\Entity\Monster[]|array
     */
    public function getRandomEnemies()
    {
        $monsters = $this->monsterRepo->findAll();
        shuffle($monsters);
        $monsters = array_slice($monsters, 0, 3);

        return $monsters;
    }

    public function prepareResponse($battleEnemies = [])
    {
        $enemies = [];

        foreach ($battleEnemies as $i => $battleEnemy) {
            $monster = $battleEnemy->getMonster();

            $enemies[] = [
                'id' => $battleEnemy->getId(),
                'slot' =>  $i + 1,
                'health' => $battleEnemy->getHealth(),
                'sprite' => $monster->getSpritePath(),
                'attack' => $battleEnemy->getAttack(),
                'defense' => $battleEnemy->getDefense()
            ];
        }

        return $enemies;
    }
}