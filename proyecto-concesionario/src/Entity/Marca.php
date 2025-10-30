<?php

namespace App\Entity;

use App\Repository\MarcaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarcaRepository::class)]
class Marca
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\OneToMany(mappedBy: 'marca', targetEntity: Coche::class, cascade: ['persist', 'remove'])]
    private Collection $coches;

    public function __construct()
    {
        $this->coches = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getNombre(): ?string { return $this->nombre; }
    public function setNombre(string $nombre): static { $this->nombre = $nombre; return $this; }

    /** @return Collection<int, Coche> */
    public function getCoches(): Collection { return $this->coches; }

    public function addCoche(Coche $coche): static {
        if (!$this->coches->contains($coche)) {
            $this->coches->add($coche);
            $coche->setMarca($this);
        }
        return $this;
    }

    public function removeCoche(Coche $coche): static {
        if ($this->coches->removeElement($coche)) {
            if ($coche->getMarca() === $this) {
                $coche->setMarca(null);
            }
        }
        return $this;
    }

    public function __toString(): string
    {
        return $this->nombre;
    }
}
