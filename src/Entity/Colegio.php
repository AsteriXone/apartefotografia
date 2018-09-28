<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Universidad
 *
 * @ORM\Table(name="colegio")
 * @ORM\Entity
 */
class Colegio
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
     * @ORM\OneToMany(targetEntity="App\Entity\GrupoColegio", mappedBy="colegio", orphanRemoval=true)
     */
    private $grupoColegios;


    public function __construct()
    {
        $this->grupos = new ArrayCollection();
        $this->grupoColegios = new ArrayCollection();
    }

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
     * @return Collection|GrupoColegio[]
     */
    public function getGrupoColegios(): Collection
    {
        return $this->grupoColegios;
    }

    public function addGrupoColegio(GrupoColegio $grupoColegio): self
    {
        if (!$this->grupoColegios->contains($grupoColegio)) {
            $this->grupoColegios[] = $grupoColegio;
            $grupoColegio->setColegio($this);
        }

        return $this;
    }

    public function removeGrupoColegio(GrupoColegio $grupoColegio): self
    {
        if ($this->grupoColegios->contains($grupoColegio)) {
            $this->grupoColegios->removeElement($grupoColegio);
            // set the owning side to null (unless already changed)
            if ($grupoColegio->getColegio() === $this) {
                $grupoColegio->setColegio(null);
            }
        }

        return $this;
    }
}
