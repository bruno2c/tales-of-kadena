<?php

namespace App\Core\Battle;


use App\Entity\BattleTurn;
use App\Interfaces\BattleCharacterInterface;
use Doctrine\ORM\EntityManager;

class BattleAction
{
    const ACTION_ATTACK = 'ATTACK';
    const ACTION_DEFEND = 'DEFEND';

    /**
     * @var BattleCharacterInterface
     */
    private $turnCharacter;

    /**
     * @var BattleCharacterInterface
     */
    private $targetCharacter;

    private $report;

    /**
     * @return BattleCharacterInterface
     */
    public function getTurnCharacter(): BattleCharacterInterface
    {
        return $this->turnCharacter;
    }

    /**
     * @param BattleCharacterInterface $turnCharacter
     */
    public function setTurnCharacter(BattleCharacterInterface $turnCharacter): void
    {
        $this->turnCharacter = $turnCharacter;
    }

    /**
     * @return BattleCharacterInterface
     */
    public function getTargetCharacter(): BattleCharacterInterface
    {
        return $this->targetCharacter;
    }

    /**
     * @param BattleCharacterInterface $targetCharacter
     */
    public function setTargetCharacter(BattleCharacterInterface $targetCharacter): void
    {
        $this->targetCharacter = $targetCharacter;
    }

    public function attack()
    {
        $turnChar = $this->getTurnCharacter();
        $targetChar = $this->getTargetCharacter();

        $attackPower = $turnChar->getAttack();
        $defensePower = $targetChar->getDefense();

        $attackResult = $attackPower - $defensePower;

        if ($attackResult < 0) {
            $attackResult = 0;
        }

        $health = $targetChar->getHealth();
        $healthResult = $targetChar->getHealth() - $attackResult;

        $targetChar->setHealth($healthResult);

        $this->report[] = [
            'action' => self::ACTION_ATTACK,
            'turnCharId' => $turnChar->getId(),
            'turnCharAttackPower' => $attackPower,
            'targetCharId' => $targetChar->getId(),
            'targetCharDefensePower' => $defensePower,
            'targetCharHealth' => $health,
            'turnCharAttackResult' => $attackResult,
            'targetCharHealthResult' => $healthResult,
        ];
    }

    public function defend()
    {
        $turnChar = $this->getTurnCharacter();

        $defensePower = $turnChar->getDefense();
        $defenseResult = $defensePower + 1;

        $turnChar->setDefense($defenseResult);

        $this->report[] = [
            'action' => self::ACTION_DEFEND,
            'turnCharId' => $turnChar->getId(),
            'turnCharAttackPower' => $turnChar->getAttack(),
            'turnCharDefensePower' => $defensePower,
            'turnCharDefenseResult' => $defenseResult,
            'targetCharId' => null,
            'targetCharDefensePower' => null,
            'targetCharHealth' => null,
            'turnCharAttackResult' => null,
            'targetCharHealthResult' => null,
        ];
    }

    public function register(EntityManager $em, BattleTurn $turn)
    {
        foreach ($this->report as $report) {

            $turn->setAction($report['action']);
            $turn->setClosed(true);

            $em->persist($turn);
            $em->flush($turn);

            if ($report['action'] == self::ACTION_ATTACK) {
                $targetChar = $this->getTargetCharacter();

                $em->persist($targetChar);
                $em->flush($targetChar);

                $turn->setTargetCharacter($targetChar);

                $em->persist($turn);
                $em->flush($turn);

                continue;
            }

            $turnChar = $this->getTurnCharacter();

            $em->persist($turnChar);
            $em->flush($turnChar);
        }
    }

    public function getReport()
    {
        return $this->report;
    }
}