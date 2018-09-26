<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Especialidad
 *
 * @ORM\Table(name="especialidad")
 * @ORM\Entity
 */
class Especialidad
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=190, unique=true)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Grupo", mappedBy="especialidad", orphanRemoval=true)
     */
    private $grupos;

    public function __construct()
    {
        $this->grupos = new ArrayCollection();
    }

//    /**
//     * @ORM\OneToMany(targetEntity="Grupo", mappedBy="especialidad")
//     */
//    private $grupo;
//
//    public function __construct()
//    {
//        $this->grupo = new ArrayCollection();
//    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->getNombre();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection|Grupo[]
     */
    public function getGrupos(): Collection
    {
        return $this->grupos;
    }

    public function addGrupo(Grupo $grupo): self
    {
        if (!$this->grupos->contains($grupo)) {
            $this->grupos[] = $grupo;
            $grupo->setEspecialidad($this);
        }

        return $this;
    }

    public function removeGrupo(Grupo $grupo): self
    {
        if ($this->grupos->contains($grupo)) {
            $this->grupos->removeElement($grupo);
            // set the owning side to null (unless already changed)
            if ($grupo->getEspecialidad() === $this) {
                $grupo->setEspecialidad(null);
            }
        }

        return $this;
    }
}
