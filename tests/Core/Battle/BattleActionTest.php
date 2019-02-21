<?php

namespace App\Tests\Core\Battle;

use App\Core\Battle\BattleAction;
use App\Entity\BattleChampion;
use App\Entity\BattleEnemy;
use PHPUnit\Framework\TestCase;


class BattleActionTest extends TestCase
{
    public function testAttack()
    {
        $battleEnemy = new BattleEnemy();
        $battleEnemy->setHealth(100);
        $battleEnemy->setDefense(0);

        $battleChampion = new BattleChampion();
        $battleChampion->setAttack(10);

        $battleAction = new BattleAction();
        $battleAction->setTurnCharacter($battleChampion);
        $battleAction->setTargetCharacter($battleEnemy);
        $battleAction->attack();

        $report = $battleAction->getReport();

        $this->assertEquals($report[0]['turnCharAttackPower'], 10);
        $this->assertEquals($report[0]['targetCharDefensePower'], 0);
        $this->assertEquals($report[0]['targetCharHealthResult'], 90);
        $this->assertEquals($report[0]['turnCharAttackPower'], 10);
    }

    public function testDefense()
    {
        $battleChampion = new BattleChampion();
        $battleChampion->setAttack(10);
        $battleChampion->setDefense(1);

        $battleAction = new BattleAction();
        $battleAction->setTurnCharacter($battleChampion);
        $battleAction->defend();

        $report = $battleAction->getReport();

        $this->assertEquals($report[0]['turnCharDefensePower'], 1);
        $this->assertEquals($report[0]['turnCharDefenseResult'], 2);
    }

}