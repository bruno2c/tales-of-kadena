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
 * @ORM\Entity(repositoryClass="App\Repository\BattleEnemyRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class BattleEnemy implements BattleCharacterInterface
{
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
     * @ManyToOne(targetEntity="Creature", cascade={"all"}, fetch="EAGER")
     * @JoinColumn(name="monster_id", referencedColumnName="id")
     */
    private $monster;

    /**
     * @ORM\Column(type="integer", nullable=true, name="max_health")
     */
    private $maxHealth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $health;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $attack;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $defense;

    /**
     * @ORM\Column(type="string", nullable=true, name="slot")
     */
    private $slot;

    /**
     * @ORM\Column(type="boolean", nullable=true, name="last_turn")
     */
    private $lastTurn;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getBattle(): ?Battle
    {
        return $this->battle;
    }

    public function setBattle(Battle $battle): self
    {
        $this->battle = $battle;

        return $this;
    }

    public function getMonster(): ?Creature
    {
        return $this->monster;
    }

    public function setMonster(Creature $monster): self
    {
        $this->monster = $monster;

        return $this;
    }

    public function getMaxHealth(): ?int
    {
        return $this->maxHealth;
    }

    public function setMaxHealth(?int $maxHealth): self
    {
        $this->maxHealth = $maxHealth;

        return $this;
    }

    public function getHealth(): ?int
    {
        return $this->health;
    }

    public function setHealth(?int $health): self
    {
        $this->health = $health;

        return $this;
    }

    public function getAttack(): ?int
    {
        return $this->attack;
    }

    public function setAttack(?int $attack): self
    {
        $this->attack = $attack;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(?int $defense): self
    {
        $this->defense = $defense;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlot()
    {
        return $this->slot;
    }

    /**
     * @param mixed $slot
     */
    public function setSlot($slot): void
    {
        $this->slot = $slot;
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
    public function isLastTurn()
    {
        return $this->lastTurn;
    }

    /**
     * @param mixed $lastTurn
     */
    public function setLastTurn($lastTurn): void
    {
        $this->lastTurn = $lastTurn;
    }
}
