<?php

namespace App\Entity\Quiz;

use App\Entity\User\Guest;
use App\Repository\Quiz\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 * @ORM\Table(name="app_quiz_team")
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $score = 0;

    /**
     * @ORM\OneToMany(targetEntity=Guest::class, mappedBy="team")
     */
    private $players;

    /**
     * @ORM\OneToOne(targetEntity=Guest::class, cascade={"persist", "remove"})
     */
    private $captain;

    public function __toString()
    {
        return (string)$this->name;
    }

    public function __construct()
    {
        $this->players = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * @return Collection|Guest[]
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Guest $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->setTeam($this);
        }

        return $this;
    }

    public function removePlayer(Guest $player): self
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getTeam() === $this) {
                $player->setTeam(null);
            }
        }

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

    public function getMembers(): array
    {
        $members = [];

        foreach ($this->getPlayers() as $player) {
            $members = array_merge(
                $members,
                array_map(
                    function ($fullName) use ($player) {
                        return [
                            'id'   => $player->getId(),
                            'name' => $fullName
                        ];
                    },
                    $player->getPersons()
                )
            );
        }

        return $members;
    }
}
