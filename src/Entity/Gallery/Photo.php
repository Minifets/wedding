<?php

namespace App\Entity\Gallery;

use App\Repository\Gallery\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 * @ORM\Table(name="app_gallery_photo")
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
     * @ORM\JoinColumn(nullable=true)
     */
    private $folder;

    /**
     * @ORM\Column(type="string", length=180)
     *
     * @Assert\NotBlank()
     */
    private $fileName;

    public function __toString()
    {
        return (string)$this->fileName;
    }

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

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getFullPath(): string
    {
        return sprintf('%s/%s', self::getBasePath(), $this->getFileName());
    }

    public static function getBasePath(): string
    {
        return 'uploads/photo';
    }
}
