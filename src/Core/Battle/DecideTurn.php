<?php

namespace App\Core\Battle;

use App\Entity\Battle;
use App\Entity\BattleChampion;
use App\Entity\BattleEnemy;
use App\Entity\BattleTurn;
use App\Interfaces\BattleCharacterInterface;
use Doctrine\ORM\EntityManager;

class DecideTurn
{
    private $characters = [];

    /**
     * @var BattleCharacterInterface
     */
    private $lastTurnChar;

    /**
     * @var BattleCharacterInterface
     */
    private $currentTurnChar;

    private $currentTurnSide;

    /**
     * @var Battle
     */
    private $battle;

    public function __construct(Battle $battle)
    {
        $this->battle = $battle;
    }

    public function addCharacter(BattleCharacterInterface $character)
    {
        if ($character->isLastTurn()) {
            $this->lastTurnChar = $character;

            return;
        }

        $this->characters[] = $character;
    }

    /** @TODO in this first moment, it will be only a random function, until agility attr is developed */
    public function roll()
    {
        $totalChars = count($this->characters);

        $currentTurnIndex = rand(0, $totalChars - 1);
        $currentTurnChar = $this->characters[$currentTurnIndex];

        $this->setCurrentTurnChar($currentTurnChar);

        return $currentTurnChar;
    }

    private function setCurrentTurnChar(BattleCharacterInterface $character)
    {
        if ($character instanceof BattleChampion) {
            $this->currentTurnSide = BattleTurn::TURN_SIDE_CHAMPIONS;
        }

        if ($character instanceof BattleEnemy) {
            $this->currentTurnSide = BattleTurn::TURN_SIDE_ENEMIES;
        }

        $this->currentTurnChar = $character;
    }

    public function getCurrentTurnSide()
    {
        return $this->currentTurnSide;
    }

    public function register(EntityManager $em)
    {
        if ($this->lastTurnChar) {
            $this->lastTurnChar->setLastTurn(0);

            $em->persist($this->lastTurnChar);
            $em->flush($this->lastTurnChar);
        }

        $this->currentTurnChar->setLastTurn(1);

        $em->persist($this->currentTurnChar);
        $em->flush($this->currentTurnChar);

        $battleTurn = new BattleTurn();
        $battleTurn->setBattle($this->battle);
        $battleTurn->setTurnCharacter($this->currentTurnChar);
        $battleTurn->setTurnSide($this->currentTurnSide);
        $battleTurn->setClosed(false);

        $em->persist($battleTurn);
        $em->flush($battleTurn);
    }
}