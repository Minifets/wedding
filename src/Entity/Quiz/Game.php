<?php

namespace App\Entity\Quiz;

use App\Repository\Quiz\GameRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 * @ORM\Table(name="app_quiz_game")
 */
class Game
{
    const STAGE_WAITING = 'waiting';
    const STAGE_CAPTAIN = 'captain';
    const STAGE_ROUND = 'round';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $stage = self::STAGE_WAITING;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $roundNumber;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStage(): ?string
    {
        return $this->stage;
    }

    public function setStage(string $stage): self
    {
        $this->stage = $stage;

        return $this;
    }

    public function getRoundNumber(): ?int
    {
        return $this->roundNumber;
    }

    public function setRoundNumber(?int $roundNumber): self
    {
        $this->roundNumber = $roundNumber;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;

        return $this;
    }
}
