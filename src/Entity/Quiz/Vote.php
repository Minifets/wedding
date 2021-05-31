<?php

namespace App\Entity\Quiz;

use App\Entity\User\Guest;
use App\Repository\Quiz\VoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoteRepository::class)
 */
class Vote
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity=Guest::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $captain;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getCaptain(): ?Guest
    {
        return $this->captain;
    }

    public function setCaptain(?Guest $captain): self
    {
        $this->captain = $captain;

        return $this;
    }
}
