<?php

namespace App\Core\Game;

use App\Core\Stage\PrepareStage;
use App\Entity\Battle;
use App\Entity\BattleEnemy;
use App\Entity\Campaign;
use App\Entity\Monster;
use App\Repository\MonsterRepository;
use Doctrine\ORM\EntityManager;

class CreateBattle
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var MonsterRepository
     */
    private $monsterRepository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->monsterRepository = $em->getRepository(Monster::class);
    }

    public function run(Campaign $campaign)
    {
        $battle = new Battle();
        $battle->setCampaign($campaign);
        $battle->setHash(uniqid('BAT', true));

        $this->em->persist($battle);
        $this->em->flush($battle);

        $prepareStage = new PrepareStage($this->monsterRepository);
        $enemies = $prepareStage->getRandomEnemies();

        $battleEnemies = [];

        foreach ($enemies as $monster) {
            $battleEnemy = new BattleEnemy();
            $battleEnemy->setMonster($monster);
            $battleEnemy->setMaxHealth($monster->getHealth());
            $battleEnemy->setHealth($monster->getHealth());
            $battleEnemy->setAttack($monster->getAttack());
            $battleEnemy->setDefense($monster->getDefense());

            $this->em->persist($battleEnemy);
            $this->em->flush($battleEnemy);

            $battleEnemies[] = $battleEnemy;
        }

        return [
            'enemies' => $prepareStage->prepareResponse($battleEnemies)
        ];
    }
}