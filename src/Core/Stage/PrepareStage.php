<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 17/02/19
 * Time: 12:11
 */

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

    public function getEnemies()
    {
        $monsters = $this->monsterRepo->findAll();
        shuffle($monsters);
        $monsters = array_slice($monsters, 0, 3);

        $enemies = [];

        foreach ($monsters as $i => $monster) {
            $enemies[] = [
                'id' => $monster->getId(),
                'slot' =>  $i + 1,
                'health' => $monster->getHealth(),
                'sprite' => $monster->getSpritePath(),
                'attack' => $monster->getAttack(),
                'defense' => $monster->getDefense()
            ];
        }

        return $enemies;
    }
}