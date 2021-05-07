<?php

namespace App\Entity\Gallery;

use App\Repository\Gallery\FolderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=FolderRepository::class)
 * @ORM\Table(name="app_gallery_folder")
 */
class Folder
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
     * @ORM\Column(type="string", length=180)
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=Photo::class, mappedBy="folder")
     */
    private $photos;

    /**
     * @ORM\Column(type="integer")
     */
    private $size = 0;

    /**
     * @ORM\ManyToOne(targetEntity=Photo::class)
     */
    private $thumbnail;

    public function __toString()
    {
        return (string)$this->name;
    }

    public function __construct()
    {
        $this->photos = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setFolder($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getFolder() === $this) {
                $photo->setFolder(null);
            }
        }

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function increaseSize(): self
    {
        $this->size++;

        return $this;
    }

    public function decreaseSize(): self
    {
        $this->size--;

        return $this;
    }

    public function getThumbnail(): ?Photo
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?Photo $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }
}
