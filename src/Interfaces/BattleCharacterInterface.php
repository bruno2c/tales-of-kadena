<?php

namespace App\Interfaces;

interface BattleCharacterInterface
{
    public function getId();

    public function getMaxHealth();

    public function setMaxHealth(?int $maxHealth);

    public function getHealth();

    public function setHealth(?int $health);

    public function getAttack();

    public function setAttack(?int $attack);

    public function getDefense();

    public function setDefense(?int $defense);

    public function isLastTurn();

    public function setLastTurn($lastTurn);
}