<?php

namespace App\Core\Game;

use App\Core\Battle\BattleResponse;
use App\Core\Stage\PrepareStage;
use App\Entity\Battle;
use App\Entity\BattleChampion;
use App\Entity\BattleEnemy;
use App\Entity\Campaign;
use App\Entity\Creature;
use App\Repository\CreatureRepository;
use Doctrine\ORM\EntityManager;

class CreateBattle
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var CreatureRepository
     */
    private $creatureRepository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->creatureRepository = $em->getRepository(Creature::class);
    }

    public function run(Campaign $campaign)
    {
        $battle = new Battle();
        $battle->setCampaign($campaign);
        $battle->setHash(uniqid('BAT', true));

        $this->em->persist($battle);
        $this->em->flush($battle);

        $prepareStage = new PrepareStage($this->creatureRepository);
        $enemies = $prepareStage->getRandomEnemies();

        $battleEnemies = [];

        foreach ($enemies as $key => $monster) {
            $slot = constant('App\Entity\Battle::BATTLE_SLOT_' . ($key+1));

            $battleEnemy = new BattleEnemy();
            $battleEnemy->setBattle($battle);
            $battleEnemy->setMonster($monster);
            $battleEnemy->setMaxHealth($monster->getHealth());
            $battleEnemy->setHealth($monster->getHealth());
            $battleEnemy->setAttack($monster->getAttack());
            $battleEnemy->setDefense($monster->getDefense());
            $battleEnemy->setSlot($slot);

            $this->em->persist($battleEnemy);
            $this->em->flush($battleEnemy);

            $battleEnemies[] = $battleEnemy;
        }

        $champions = $prepareStage->getRandomChampions();
        $battleChampions = [];

        foreach ($champions as $key => $champion) {
            $slot = constant('App\Entity\Battle::BATTLE_SLOT_' . ($key+1));

            $battleChampion = new BattleChampion();
            $battleChampion->setBattle($battle);
            $battleChampion->setChampion($champion);
            $battleChampion->setMaxHealth($champion->getHealth());
            $battleChampion->setHealth($champion->getHealth());
            $battleChampion->setAttack($champion->getAttack());
            $battleChampion->setDefense($champion->getDefense());
            $battleChampion->setSlot($slot);

            $this->em->persist($battleChampion);
            $this->em->flush($battleChampion);

            $battleChampions[] = $battleChampion;
        }

        return $battle;
    }
}