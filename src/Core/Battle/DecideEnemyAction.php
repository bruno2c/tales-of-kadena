<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 02/03/19
 * Time: 20:51
 */

namespace App\Core\Battle;


use App\Entity\Battle;
use App\Entity\BattleChampion;
use App\Entity\BattleEnemy;
use App\Entity\BattleTurn;
use App\Interfaces\BattleCharacterInterface;
use Doctrine\ORM\EntityManager;

class DecideEnemyAction
{
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var BattleCharacterInterface
     */
    private $character;

    private $champions = [];

    /**
     * @var BattleTurn
     */
    private $turn;

    /**
     * @var Battle
     */
    private $battle;

    public function __construct(EntityManager $em, Battle $battle)
    {
        $this->em = $em;
        $this->battle = $battle;
    }

    /**
     * @return BattleCharacterInterface
     */
    public function getCharacter(): BattleCharacterInterface
    {
        return $this->character;
    }

    public function roll()
    {
        $this->turn = $this->findOpenTurn($this->battle);
        $this->champions = $this->findChampions($this->battle);
        $this->character = $this->em->getRepository(BattleEnemy::class)->find($this->turn->getTurnCharacter());

        $actions = BattleAction::$actions;
//        $actionIndex = rand(0, (count($actions) - 1));
        $action = $actions[0];

        $totalChampions = count($this->champions);
        $championIndex = rand(0, ($totalChampions - 1));
        $target = $this->champions[$championIndex];

        return [
            'action' => $action,
            'target' => $target
        ];
    }

    private function findOpenTurn(Battle $battle)
    {
        $turn = $this->em->getRepository(BattleTurn::class)->getOpenTurn($battle);

        if (!$turn) {
            throw new \Exception('Invalid request, no one open turn found');
        }

        if ($turn->getTurnSide() != BattleTurn::TURN_SIDE_ENEMIES) {
            throw new \Exception('Invalid request, it is not an enemy turn');
        }

        return $turn;
    }

    private function findChampions(Battle $battle)
    {
        return $this->em->getRepository(BattleChampion::class)->findBy(['battle' => $battle]);
    }

    public function register($action = [])
    {
        if (!isset($action['action']) || !$action['action']) {
            throw new \Exception('Invalid action, target not action');
        }

        if (!isset($action['target']) || !$action['target']) {
            throw new \Exception('Invalid action, target not defined');
        }

        $battleAction = new BattleAction();
        $battleAction->setTurnCharacter($this->character);
        $battleAction->setTargetCharacter($action['target']);
        $battleAction->setAction($action['action']);
        $battleAction->execute();
        $battleAction->register($this->em, $this->turn);

        return $battleAction;
    }

}