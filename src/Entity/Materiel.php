<?php

namespace App\Entity;

use App\Repository\MaterielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterielRepository::class)]
class Materiel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $quantity = null;

    /**
     * @var Collection<int, EventMateriel>
     */
    #[ORM\OneToMany(targetEntity: EventMateriel::class, mappedBy: 'materiel')]
    private Collection $programmation;

    public function __construct()
    {
        $this->programmation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return Collection<int, EventMateriel>
     */
    public function getProgrammation(): Collection
    {
        return $this->programmation;
    }

    public function addProgrammation(EventMateriel $programmation): static
    {
        if (!$this->programmation->contains($programmation)) {
            $this->programmation->add($programmation);
            $programmation->setMateriel($this);
        }

        return $this;
    }

    public function removeProgrammation(EventMateriel $programmation): static
    {
        if ($this->programmation->removeElement($programmation)) {
            // set the owning side to null (unless already changed)
            if ($programmation->getMateriel() === $this) {
                $programmation->setMateriel(null);
            }
        }

        return $this;
    }
}
