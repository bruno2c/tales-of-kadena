<?php

namespace App\Entity;

use App\Interfaces\BattleCharacterInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BattleTurnRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class BattleTurn
{
    const TURN_SIDE_CHAMPIONS = 'CHAMPIONS';
    const TURN_SIDE_ENEMIES = 'ENEMIES';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Battle", cascade={"all"}, fetch="EAGER")
     * @JoinColumn(name="battle_id", referencedColumnName="id")
     */
    private $battle;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="turn_side")
     */
    private $turnSide;

    /**
     * @ORM\Column(type="integer", nullable=true, name="turn_character_id")
     */
    private $turnCharacter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $action;

    /**
     * @ORM\Column(type="integer", nullable=true, name="target_character_id")
     */
    private $targetCharacter;

    /**
     * @ORM\Column(type="boolean", length=255, nullable=true)
     */
    private $closed;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="created_at")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="updated_at")
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTurnSide(): ?string
    {
        return $this->turnSide;
    }

    public function setTurnSide(?string $turnSide): self
    {
        $this->turnSide = $turnSide;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number): void
    {
        $this->number = $number;
    }

    /**
     * @return BattleCharacterInterface
     */
    public function getTurnCharacter()
    {
        return $this->turnCharacter;
    }

    /**
     * @param BattleCharacterInterface $turnCharacter
     */
    public function setTurnCharacter(BattleCharacterInterface $turnCharacter): void
    {
        $this->turnCharacter = $turnCharacter->getId();
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }



    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        if (!$this->createdAt) {
            $this->createdAt = new \DateTime();
        }
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        if (!$this->createdAt) {
            $this->createdAt = new \DateTime();
        }

        $this->updatedAt = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action): void
    {
        $this->action = $action;
    }

    /**
     * @return BattleCharacterInterface
     */
    public function getTargetCharacter()
    {
        return $this->targetCharacter;
    }

    /**
     * @param BattleCharacterInterface $targetCharacter
     */
    public function setTargetCharacter(BattleCharacterInterface $targetCharacter): void
    {
        $this->targetCharacter = $targetCharacter->getId();
    }

    /**
     * @return Battle
     */
    public function getBattle(): Battle
    {
        return $this->battle;
    }

    /**
     * @param Battle $battle
     */
    public function setBattle(Battle $battle): void
    {
        $this->battle = $battle;
    }

    /**
     * @return mixed
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * @param mixed $closed
     */
    public function setClosed($closed): void
    {
        $this->closed = $closed;
    }
}
