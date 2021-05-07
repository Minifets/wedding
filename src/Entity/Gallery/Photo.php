<?php

namespace App\Entity\Gallery;

use App\Repository\Gallery\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 */
class Photo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Folder::class, inversedBy="photos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $folder;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFolder(): ?Folder
    {
        return $this->folder;
    }

    public function setFolder(?Folder $folder): self
    {
        if ($this->folder instanceof Folder) {
            $this->folder->decreaseSize();
        }

        $this->folder = $folder;
        $this->folder->increaseSize();

        return $this;
    }
}
