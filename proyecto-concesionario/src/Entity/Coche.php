<?php

namespace App\Entity;

use App\Repository\CocheRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CocheRepository::class)]
class Coche
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $modelo = null;

    #[ORM\Column]
    private ?int $anio = null;

    #[ORM\ManyToOne(inversedBy: 'coches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Marca $marca = null;

    public function getId(): ?int 
    { 
        return $this->id; 
    }

    public function getModelo(): ?string 
    { 
        return $this->modelo; 
    }

    public function setModelo(string $modelo): static 
    { 
        $this->modelo = $modelo; return $this; 
    }

    public function getAnio(): ?int 
    { 
        return $this->anio; 
    }
    
    public function setAnio(int $anio): static 
    { 
        $this->anio = $anio; return $this; 
    }

    public function getMarca(): ?Marca 
    { 
        return $this->marca; 
    }

    public function setMarca(?Marca $marca): static 
    { 
        $this->marca = $marca; return $this; 
    }
}
